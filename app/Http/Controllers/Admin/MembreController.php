<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use App\Models\Membre;
use App\Models\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MembreController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $query = Membre::with('entites');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('poste', 'like', '%'.$request->search.'%');
            });
        }

        $membres = $query->orderBy('niveau')
                        ->orderBy('ordre')
                        ->paginate(10);

        return view('admin.membres.index', compact('membres'));
    }

    public function create()
    {
        $entites = Entite::orderBy('nom')->get();

        return view('admin.membres.create', compact('entites'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        try {
            $membre = Membre::create($this->prepareMemberData($validated, $request));
            $this->syncMemberEntities($membre, $validated);

            toastr('Membre ajouté avec succès','success');

            return redirect()->route('admin.membres.index');

        } catch (\Exception $e) {
            Log::error("Erreur création membre: ".$e->getMessage());
            return back();
            toastr('Erreur lors de la création','error');
        }
    }

    public function show($id)
    {
        $membre = Membre::with(['entites' => function($query) {
            $query->orderBy('nom');
        }])->findOrFail($id);

        return view('admin.membres.show', compact('membre'));
    }

    public function edit($id)
    {
        $membre = Membre::with('entites')->findOrFail($id);
        $entites = Entite::orderBy('nom')->get();

        return view('admin.membres.edit', compact('membre', 'entites'));
    }

    public function update(Request $request, $id)
    {
        $membre = Membre::findOrFail($id);
        $validated = $this->validateRequest($request, $membre);

        try {
            $this->handlePhotoUpdate($membre, $request, $validated);
            $membre->update($this->prepareMemberData($validated, $request));
            $this->syncMemberEntities($membre, $validated);

            toastr('Membre modifié avec succès!', 'success');

            return redirect()->route('admin.membres.show', $membre);

        } catch (\Exception $e) {
            Log::error("Erreur mise à jour membre: ".$e->getMessage());
            return back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);

        try {
            $this->deleteImage($membre->photo);
            $membre->entites()->detach();
            $membre->delete();

            return response(['status' => 'success', 'message' => 'Membre supprimée!']);

        } catch (\Exception $e) {
            Log::error("Erreur suppression membre: ".$e->getMessage());
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }
    }

    public function parEntite(Entite $entite)
    {
        $membres = $entite->membres()
                         ->orderBy('niveau')
                         ->orderBy('ordre')
                         ->paginate(10);

        return view('admin.membres.index', [
            'membres' => $membres,
            'title' => "Membres de l'entité: ".$entite->nom
        ]);
    }

    private function validateRequest(Request $request, $membre = null)
    {
        return $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'email' => 'nullable|email|unique:membres,email'.($membre ? ','.$membre->id : ''),
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'ordre' => 'required|integer',
            'niveau' => 'required|integer|between:1,6',
            'entites' => 'nullable|array',
            'entites.*' => 'exists:entites,id',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|string|max:100',
            'remove_photo' => 'nullable|boolean'
        ]);
    }

    private function prepareMemberData($validated, Request $request)
    {
        $data = $validated;

        $imagePath = $this->uploadImage($request, 'photo', 'uploads/membres');

        $data['photo'] = $imagePath;

        if (!isset($data['ordre'])) {
            $data['ordre'] = Membre::max('ordre') + 1;
        }

        return $data;
    }

    private function syncMemberEntities($membre, $validated)
    {
        $entitesData = [];

        if (!empty($validated['entites'])) {
            foreach ($validated['entites'] as $entiteId) {
                $entitesData[$entiteId] = [
                    'role' => $validated['roles'][$entiteId] ?? null,
                    'date_debut' => now()
                ];
            }
        }

        $membre->entites()->sync($entitesData);
    }

    private function handlePhotoUpdate($membre, Request $request, &$validated)
    {
        if ($request->has('remove_photo')) {
            $this->deleteImage($membre->photo);
            $validated['photo'] = null;
        }
    }

    private function deleteMemberPhoto($membre)
    {
        if ($membre->photo) {
            $this->deleteImage($membre->photo);
        }
    }
}

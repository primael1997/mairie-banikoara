<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use App\Models\SecretariatMembre;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class SecretariatMembreController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $membres = SecretariatMembre::orderBy('niveau')->orderBy('ordre')->get();

        return view('mespages.secretariat', compact('membres'));
    }

    public function fiche($id)
    {
        $membre = SecretariatMembre::findOrFail($id);

        return view('mespages.ficheposte', compact('membre'));
    }

    public function exportPdf($id)
    {
        $membre = SecretariatMembre::findOrFail($id);
        $pdf = Pdf::loadView('pdf.ficheposte', compact('membre'));

        return $pdf->download('fiche_poste_' . $membre->id . '.pdf');
    }

    public function manage()
    {
        $membres = SecretariatMembre::orderBy('niveau')->orderBy('ordre')->get();

        return view('admin.secretariat.index', compact('membres'));
    }

    public function create()
    {
        return view('admin.secretariat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'attributions' => 'nullable|string',
            'niveau' => 'required|integer',
            'ordre' => 'required|integer',
        ]);

        $imagePath = $this->uploadImage($request, 'photo', 'uploads/executif');

        $data['photo'] = $imagePath;

        SecretariatMembre::create($data);

        toastr('Membre ajouté avec succès','success');
        return redirect()->route('admin.secretariat.index');
    }

    public function edit($id)
    {
        $membre = SecretariatMembre::findOrFail($id);

        return view('admin.secretariat.edit', compact('membre'));
    }

    public function update(Request $request, $id)
    {
        $membre = SecretariatMembre::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'attributions' => 'nullable|string',
            'niveau' => 'required|integer',
            'ordre' => 'required|integer',
        ]);

        $imagePath = $this->updateImage($request, 'photo', 'uploads/executif', $membre->logo);

        $data['logo'] = empty(!$imagePath) ? $imagePath : $membre->logo;

        $membre->update($data);

        toastr('Membre modifié avec succès','success');
        return redirect()->route('admin.secretariat.index');
    }

    public function destroy($id)
    {
        $membre = SecretariatMembre::findOrFail($id);
        $this->deleteImage($membre->image);
        $membre->delete();

        return response(['status' => 'success', 'message' => 'Membre supprimé!']);
    }
}

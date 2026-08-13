<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    public function index()
    {
        $entites = Entite::withCount('membres')->orderBy('nom')->get();

        return view('admin.entites.index', compact('entites'));
    }

    public function create()
    {
        return view('admin.entites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:entites',
            'description' => 'nullable|string',
            'type' => 'required|in:conseil,commission,delegation,autre'
        ]);

        Entite::create($validated);

        toastr('Entité ajouté avec succès!', 'success');

        return back();
    }

    public function showMembres(Entite $entite)
{
    $membres = $entite->membres()
                     ->orderBy('niveau')
                     ->orderBy('ordre')
                     ->get();

    return view('admin.entites.membres', compact('entite', 'membres'));
}


    public function edit(Entite $entite)
    {
        return view('admin.entites.edit', compact('entite'));
    }

    public function update(Request $request, Entite $entite)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:entites,nom,'.$entite->id,
            'description' => 'nullable|string',
            'type' => 'required|in:conseil,commission,delegation,autre'
        ]);

        $entite->update($validated);


        toastr('Entitée modifiée avec succès', 'success');
        return back();
    }

    public function destroy(Entite $entite)
    {
        // $ent = Entite::find($entite);
        $entite->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}

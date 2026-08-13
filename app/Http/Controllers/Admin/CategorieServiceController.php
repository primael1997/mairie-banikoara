<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use App\Models\CategorieService;
use App\Models\Service;
use Yoeunes\Toastr\Toastr;

class CategorieServiceController extends Controller
{
    /**
     * Afficher la liste des catégories.
     */
    public function index()
    {
        $categories = CategorieService::paginate(10);

        return view('admin.categorie_services.index', compact('categories'));

    }


    /**
     * Afficher le formulaire de création d'une catégorie.
     */
    public function create()
    {
        return view('admin.categorie_services.create');
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255|unique:categorie_services',
        ]);

        CategorieService::create([
            'libelle' => $request->libelle,
        ]);

        Toastr('Catégorie ajoutée avec succès','success');
        return back();
    }

    /**
     * Afficher le formulaire d'édition d'une catégorie.
     */
    public function edit($id)
    {
        $categorie = CategorieService::findOrFail($id);

        return view('categorie_services.edit', compact('categorie'));
    }

    /**
     * Mettre à jour une catégorie.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'libelle' => 'required|string|max:255|unique:categorie_services,libelle,' . $id,
    ]);

    $categorie = CategorieService::findOrFail($id);
    $categorie->update([
        'libelle' => $request->libelle,
    ]);

    toastr('Catégorie modifiée avec succès','success');
    return redirect()->route('admin.categorie_services.index');
}

    /**
     * Supprimer une catégorie.
     */
    public function destroy($id)
    {
        $categorie = CategorieService::find($id);

        if(Service::where('categorie_service_id', $categorie->id)->count() > 0){
            return response(['status' => 'error', 'message' => 'This Category have Service you can\'t delete it.']);
        }
        $categorie->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

}

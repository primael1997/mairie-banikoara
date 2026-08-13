<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Categorie;
use Illuminate\Http\Request;


class CategorieController extends Controller
{
    // Afficher la liste des catégories
    public function index()
    {
        $categories = Categorie::orderBy('id','desc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    // Afficher le formulaire d’ajout d’une catégorie
    public function create()
    {
        return view('categories.create');
    }

    // Enregistrer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|unique:categories,libelle',
        ]);

        Categorie::create($request->all());

        toastr('Catégorie ajoutée avec succès','success');
        return back();
    }

    // Afficher les détails d’une catégorie (optionnel selon besoin)
    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);

        return view('admin.categories.show', compact('categorie'));
    }

    // Afficher le formulaire de modification d’une catégorie
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);

        return view('admin.categories.edit', compact('categorie'));
    }

    // Mettre à jour une catégorie existante
    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|unique:categories,libelle,' . $id,
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        toastr('Catégorie modifiée avec succès','success');

        return redirect()->route('admin.categories.index');
    }

    // Supprimer une catégorie
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        if(Actualite::where('categorie_id', $category->id)->count() > 0){
            return response(['status' => 'error', 'message' => 'This Category have Actuality you can\'t delete it.']);
        }
        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}

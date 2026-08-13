<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorieDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Toastr;

class CategorieDocumentController extends Controller
{
    /**
     * Afficher la liste des catégories (admin)
     */
    public function index()
    {
        $categories = CategorieDocument::withCount('documents')
            ->ordered()
            ->paginate(10);

        return view('admin.categories-documents.index', compact('categories'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('admin.categories-documents.create');
    }

    /**
     * Enregistrer une nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories_documents,nom',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        // Récupère le dernier ordre (sinon 0)
        $lastOrder = CategorieDocument::max('ordre') ?? 0;

        // Le prochain ordre
        $nextOrder = $lastOrder + 1;

        $category = new CategorieDocument();
        $category->nom = $validated['nom'];
        $category->slug = Str::slug($validated['nom']);
        $category->description = $validated['description'] ?? null;
        $category->icone = 'fas fa-file';
        $category->ordre = $nextOrder;

        // Génère une couleur aléatoire
        $color = random_hex_color();

        // Enregistre la couleur + la couleur de contraste
        $category->couleur = $color;
        // $category->couleur = contrast_color($color);

        $category->active = $validated['active'] ?? true;

        $category->save();

        toastr('Catégorie créée avec succès','success');
        return back();
    }

    /**
     * Afficher une catégorie spécifique
     */
    public function show(CategorieDocument $categorieDocument)
    {
        $categorieDocument->load(['documents' => function($query) {
            $query->public()->nonArchive()->latest();
        }]);

        return view('admin.categories-documents.show', compact('categorieDocument'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(CategorieDocument $categorieDocument)
    {
        return view('admin.categories-documents.edit', compact('categorieDocument'));
    }

    /**
     * Mettre à jour une catégorie
     */
    public function update(Request $request, CategorieDocument $categorieDocument)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories_documents,nom,'.$categorieDocument->id,
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        // Récupère le dernier ordre (sinon 0)
        $lastOrder = CategorieDocument::max('ordre') ?? 0;

        $category = CategorieDocument::where('id',$categorieDocument->id)->first();

        // Le prochain ordre
        $nextOrder = $lastOrder + 1;

        $category->nom = $validated['nom'];
        $category->slug = Str::slug($validated['nom']);
        $category->description = $validated['description'] ?? null;
        $category->icone = 'fas fa-file';
        $category->ordre = $nextOrder;

        // Génère une couleur aléatoire
        $color = random_hex_color();

        // Enregistre la couleur + la couleur de contraste
        $category->couleur = $color;
        // $category->couleur = contrast_color($color);

        $category->active = $validated['active'] ?? true;

        $category->save();

        toastr('Catégorie modifié avec succès','success');
        return back();
    }

    /**
     * Supprimer une catégorie
     */
    public function destroy(CategorieDocument $categorieDocument)
    {
        // Vérifier s'il y a des documents associés
        if ($categorieDocument->documents()->count() > 0) {

            return response(['status' => 'error', 'message' => 'Impossible de supprimer cette catégorie car elle contient des documents']);

        }

        $categorieDocument->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * Mettre à jour l'ordre des catégories
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories_documents,id'
        ]);

        foreach ($request->categories as $index => $categoryId) {
            CategorieDocument::where('id', $categoryId)->update(['ordre' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Basculer le statut actif/inactif
     */
    public function toggleActive(CategorieDocument $categorieDocument)
    {
        $categorieDocument->update(['active' => !$categorieDocument->active]);

        return redirect()->route('admin.categories-documents.index')
            ->with('success', 'Statut de la catégorie mis à jour.');
    }

    /**
     * Afficher les documents d'une catégorie (frontend)
     */
    public function showDocuments($slug)
    {
        $categorie = CategorieDocument::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $documents = $categorie->documentsPublics()->paginate(12);

        return view('public.documents.categorie', compact('categorie', 'documents'));
    }

    /**
     * API pour récupérer les catégories actives
     */
    public function getActiveCategories()
    {
        $categories = CategorieDocument::active()
            ->ordered()
            ->withCount(['documents' => function($query) {
                $query->public()->nonArchive();
            }])
            ->get();

        return response()->json($categories);
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use File;
use App\Models\Actualite;
use App\Models\Categorie;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActualiteController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $actualites = Actualite::orderBy('id','desc')->paginate(10);

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        $categories = Categorie::orderBy('libelle','asc')->get();

        return view('admin.actualites.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $actualite = new Actualite();

        // Gestion de l'image avec disque 'uploads'
        $image = $this->uploadImage($request, 'image', 'uploads/actualites');
        $actualite->titre = $request->titre;
        $actualite->slug = Str::slug($request->titre);
        $actualite->contenu = $request->contenu;
        $actualite->date_publication = $request->date_publication;
        $actualite->categorie_id = $request->categorie_id;
        $actualite->image = $image;

        $actualite->save();

        toastr('Actualité créée avec succès.','success');
        return redirect()->route('admin.actualites.index');
    }

    public function show($slug)
    {
        $actualite = Actualite::where('slug', $slug)->first();

        if (!$actualite) {
            abort(404, 'Actualité introuvable');
        }

        return view('admin.actualites.show', compact('actualite'));
    }


    public function edit(Actualite $actualite)
    {
        $categories = Categorie::all();

        return view('admin.actualites.edit', compact('actualite', 'categories'));
    }


    public function update(Request $request, Actualite $actualite)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $actualite->find($actualite->id);

        $imagePath = $this->updateImage($request, 'image', 'uploads/actualites', $actualite->image);

        $actualite->titre = $request->titre;
        $actualite->slug = Str::slug($request->titre);
        $actualite->contenu = $request->contenu;
        $actualite->date_publication = $request->date_publication;
        $actualite->categorie_id = $request->categorie_id;
        $actualite->image = empty(!$imagePath) ? $imagePath : $actualite->image;

        $actualite->save();

        toastr('Actualité mise à jour avec succès.','success');
        return redirect()->route('admin.actualites.index');
    }

    public function destroy(Actualite $actualite)
    {
        $actualite = Actualite::findOrFail($actualite);
        $this->deleteImage($actualite->image);
        $actualite->delete();

        return response(['status' => 'success', 'message' => 'Actualité supprimée!']);
    }
}

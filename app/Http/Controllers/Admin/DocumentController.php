<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\CategorieDocument;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DocumentController extends Controller
{
    use ImageUploadTrait;
    /**
     * Afficher la liste des documents (admin)
     */
    public function index2()
    {
        $documents = Document::with('categorieDocument')
            ->latest()
            ->paginate(10);


        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $categories = CategorieDocument::where('active', true)->orderBy('ordre')->get();

        return view('admin.documents.create', compact('categories'));
    }

    /**
     * Enregistrer un nouveau document
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_document_id' => 'nullable|exists:categories_documents,id',
            'date_publication' => 'nullable|date',
            'fichier' => 'required|mimes:pdf|max:10240',
            'public' => 'boolean'
        ]);

        $document = new Document();

        $file = $request->file('fichier');
        $taille_fichier = round($file->getSize() / (1024 * 1024),2);

        $file_doc = $this->uploadFile($request, 'fichier', 'uploads/documents');

        $document->titre = $validated['titre'];
        $document->categorie_document_id = $validated['categorie_document_id'];
        $document->date_publication = $validated['date_publication'];
        $document->fichier = $file_doc;
        $document->taille_fichier = $taille_fichier;

        $document->save();

        toastr('Document mise à jour avec succès.','success');
        
        return redirect()->route('admin.mairie.documents.index');
    }

    /**
     * Afficher un document spécifique
     */
    public function show(Document $document)
    {

        if (Schema::hasColumn('documents', 'nb_vues')) {
            $document->increment('nb_vues');
            if (Schema::hasColumn('documents', 'derniere_vue')) {
                $document->update(['derniere_vue' => now()]);
            }
        }

        return response()->file(Storage::disk('uploads')->path($document->fichier));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Document $document)
    {
        $categories = CategorieDocument::where('active', true)->orderBy('ordre')->get();

        return view('admin.documents.edit', compact('document', 'categories'));
    }

    /**
     * Mettre à jour un document
     */
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_document_id' => 'nullable|exists:categories_documents,id',
            'date_publication' => 'nullable|date',
            'fichier' => 'nullable|mimes:pdf|max:10240',
            'public' => 'boolean',
            'archive' => 'boolean'
        ]);

        $document = Document::findOrFail($document);

        $filePath = $this->updateFile($request, 'files', 'uploads/documents', $document->image);

        $file = $request->file('fichier');

        $filename = time() . '_' . $file->getClientOriginalName();

        $document->titre = $validated['titre'];
        $document->description = $validated['description'];
        $document->categorie_document_id = $validated['categorie_document_id'];
        $document->date_publication = $validated['date_publication'];
        $document->fichier = $filePath;
        $document->public = $validated['public'];
        $document->taille_fichier = $file->getSize();

        $document->save();

        toastr('Document mise à jour avec succès.','success');
        return redirect()->route('admin.actualites.index');
    }

    /**
     * Supprimer un document
     */
    public function destroy(Document $document)
    {
        $file = Document::findOrFail($document);
        $this->deleteImage($file->image);
        $this->deleteImage($file->file);

        $file->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }

    /**
     * Télécharger un document
     */
    public function download(Document $document)
    {
        // Vérifier si le document est public (sauf pour les admins)
        if (Schema::hasColumn('documents', 'public') && !$document->public && !auth()->check()) {
            abort(403, 'Accès refusé à ce document.');
        }

        if (!Storage::disk('uploads')->exists('documents/' . $document->fichier)) {
            return back()->with('error', 'Le fichier demandé est introuvable.');
        }

        // Incrémenter le compteur de téléchargements si la colonne existe
        if (Schema::hasColumn('documents', 'nb_telechargements')) {
            $document->increment('nb_telechargements');
        }

        return Storage::disk('uploads')->download( $document->fichier, $document->titre . '.pdf');
    }

    /**
     * Basculer le statut public/privé
     */
    public function togglePublic(Document $document)
    {
        if (Schema::hasColumn('documents', 'public')) {
            $document->update(['public' => !$document->public]);
        }

        return redirect()->route('admin.documents.index')
            ->with('success', 'Statut du document mis à jour.');
    }

    /**
     * Archiver/désarchiver un document
     */
    public function toggleArchive(Document $document)
    {
        if (Schema::hasColumn('documents', 'archive')) {
            $document->update(['archive' => !$document->archive]);
        }

        return redirect()->route('admin.documents.index')
            ->with('success', 'Statut d\'archivage mis à jour.');
    }
}

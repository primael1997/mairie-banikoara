<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'fichier',
        'categorie', // Ancienne catégorie (texte libre) - à conserver pour compatibilité
        'categorie_document_id', // Nouvelle relation
        'date_publication',
        'description',
        'taille_fichier',
        'nb_pages',
        'nb_telechargements',
        'nb_vues',
        'derniere_vue',
        'public',
        'archive'
    ];

    protected $casts = [
        'date_publication' => 'date',
        'derniere_vue' => 'datetime',
        'public' => 'boolean',
        'archive' => 'boolean',
        'nb_telechargements' => 'integer',
        'nb_vues' => 'integer',
        'taille_fichier' => 'integer',
        'nb_pages' => 'integer'
    ];

    /**
     * Relation avec la catégorie
     */
    public function categorieDocument()
    {
        return $this->belongsTo(CategorieDocument::class, 'categorie_document_id');
    }

    /**
     * Récupérer le nom de la catégorie
     */
    public function getCategorieNomAttribute()
    {
        return $this->categorieDocument ? $this->categorieDocument->nom : ($this->categorie ?? 'Général');
    }

    /**
     * Récupérer la couleur de la catégorie
     */
    public function getCategorieCouleurAttribute()
    {
        return $this->categorieDocument ? $this->categorieDocument->couleur : '#6c757d';
    }

    /**
     * Récupérer l'icône de la catégorie
     */
    public function getCategorieIconeAttribute()
    {
        return $this->categorieDocument ? $this->categorieDocument->icone : 'fas fa-file';
    }

    /**
     * Récupérer l'URL du fichier
     */
    public function getUrlFichierAttribute()
    {
        return Storage::disk('uploads')->url('documents/' . $this->fichier);
    }

    /**
     * Récupérer le chemin complet du fichier
     */
    public function getCheminFichierAttribute()
    {
        return Storage::disk('uploads')->path('documents/' . $this->fichier);
    }

    /**
     * Vérifier si le fichier existe
     */
    public function fichierExiste()
    {
        return Storage::disk('uploads')->exists('documents/' . $this->fichier);
    }

    /**
     * Formater la taille du fichier
     */
    public function getTailleFormateeAttribute()
    {
        if (!$this->taille_fichier) return 'N/A';
        
        $bytes = $this->taille_fichier;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Incrémenter le compteur de téléchargements
     */
    public function incrementerTelechargements()
    {
        $this->increment('nb_telechargements');
    }

    /**
     * Incrémenter le compteur de vues
     */
    public function incrementerVues()
    {
        $this->increment('nb_vues');
        $this->update(['derniere_vue' => now()]);
    }

    /**
     * Scope pour les documents publics
     */
    public function scopePublic($query)
    {
        return $query->where('public', true);
    }

    /**
     * Scope pour les documents non archivés
     */
    public function scopeNonArchive($query)
    {
        return $query->where('archive', false);
    }

    /**
     * Scope pour rechercher dans les documents
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where(function($q) use ($terme) {
            $q->where('titre', 'LIKE', "%{$terme}%")
              ->orWhere('description', 'LIKE', "%{$terme}%");
        });
    }

    /**
     * Scope pour filtrer par catégorie
     */
    public function scopeParCategorie($query, $categorieId)
    {
        return $query->where('categorie_document_id', $categorieId);
    }
}

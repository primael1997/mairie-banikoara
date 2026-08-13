<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategorieDocument extends Model
{
    use HasFactory;

    protected $table = 'categories_documents';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'couleur',
        'icone',
        'active',
        'ordre'
    ];

    protected $casts = [
        'active' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Relation avec les documents
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'categorie_document_id');
    }

    /**
     * Compter les documents publics de cette catégorie
     */
    public function documentsPublicsCount()
    {
        return $this->documents()->where('public', true)->where('archive', false)->count();
    }

    /**
     * Récupérer les documents publics de cette catégorie
     */
    public function documentsPublics()
    {
        return $this->documents()->where('public', true)->where('archive', false)->latest();
    }

    /**
     * Générer automatiquement le slug
     */
    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Scope pour récupérer les catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope pour ordonner par ordre
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre', 'asc')->orderBy('nom', 'asc');
    }

    /**
     * Récupérer l'URL de la catégorie
     */
    public function getUrlAttribute()
    {
        return route('documents.categorie', $this->slug);
    }
}

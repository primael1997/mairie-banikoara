<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    use HasFactory;

    /**
     * Les attributs mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'description',
        'slug' // Optionnel pour les URLs SEO-friendly
    ];

    /**
     * Relation many-to-many avec les membres
     */
   public function membres()
{
    return $this->belongsToMany(Membre::class, 'membre_entite')
               ->withPivot(['role', 'date_debut', 'date_fin', 'fonction'])
               ->withTimestamps();
}

    /**
     * Génère un slug avant la création
     */
    protected static function booted()
    {
        static::creating(function ($entite) {
            $entite->slug = \Str::slug($entite->nom);
        });

        static::updating(function ($entite) {
            $entite->slug = \Str::slug($entite->nom);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

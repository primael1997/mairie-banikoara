<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'poste',
        'photo',
        'niveau',
    ];

    // Ajoutez cette relation
public function entites()
{
    return $this->belongsToMany(Entite::class, 'membre_entite')
               ->withPivot(['role', 'date_debut', 'date_fin', 'fonction'])
               ->withTimestamps();
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'date_publication',
        'image',
        'categorie_id'
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    protected $casts = [
        'date_publication' => 'date',
    ];


}



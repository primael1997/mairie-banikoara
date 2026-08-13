<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecretariatMembre extends Model
{
    protected $table = 'secretariat_membres'; // Nom correct de la table

    protected $fillable = [
        'nom',
        'poste',
        'photo',
        'contact',
        'email',
        'attributions',
        'niveau',
        'ordre',
    ];
}

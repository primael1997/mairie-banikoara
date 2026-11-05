<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
     protected $fillable = [
        'numero',
        'type',
        'nom',
        'email',
        'telephone',
        'sujet',
        'message',
        'statut',
    ];
}

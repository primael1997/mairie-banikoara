<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotDuMaire extends Model
{
    // Corriger le nom de la table manuellement
    protected $table = 'mot_du_maire';

    protected $fillable = [
        'nom',
        'titre',
        'message_1',
        'message_2',
        'photo',
    ];
}

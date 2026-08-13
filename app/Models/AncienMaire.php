<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AncienMaire extends Model
{
    protected $table = 'anciens_maires';

    protected $fillable = [
        'nom',
        'mandat',
        'biographie',
        'photo',
    ];
}

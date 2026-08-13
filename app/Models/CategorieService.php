<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieService extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];

    public function services()
    {
        return $this->hasMany(Service::class, 'categorie_service_id');
    }

}

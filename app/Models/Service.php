<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    protected $fillable = ['titre', 'slug', 'description', 'categorie_service_id', 'image', 'cout', 'pieces_fournir'];




    public function categorie()
{
    return $this->belongsTo(CategorieService::class, 'categorie_service_id');
}

}

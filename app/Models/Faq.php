<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'order',
        'category',
        'is_published'
    ];

    // Scope pour récupérer seulement les FAQs publiées
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order');
    }

    // Scope pour filtrer par catégorie
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}

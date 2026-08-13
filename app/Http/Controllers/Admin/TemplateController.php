<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite; // N'oublie pas d'importer le modèle
use App\Models\CategorieService;
use App\Models\Partenaire;

class TemplateController extends Controller
{
   public function index()
{
    // Récupérer les 3 dernières actualités
    $actualites = Actualite::orderBy('date_publication', 'desc')->take(3)->get();

    // Récupérer les catégories avec leurs services
    $categories = CategorieService::with('services')->get();

    // Récupérer les services récents
    $services = \App\Models\Service::with('categorie')->orderBy('created_at', 'desc')->take(9)->get();

    // Récupérer tous les partenaires
    $partenaires = Partenaire::all();

    // Passer à la vue
    return view('frontend.acceuil', compact('actualites', 'categories', 'services', 'partenaires'));
}


}


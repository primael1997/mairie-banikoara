<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\CategorieService;
use App\Models\Document;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $flashs = Actualite::orderBy('created_at','desc')->take(10)->get(['id','titre']);

        $posts = Actualite::with('categorie')
            ->latest()
            ->take(6)
            ->get()
            ->map(fn ($post) => [
                'titre' => $post->titre,
                'slug' => $post->slug,
                'image' => $post->image,
                'excerpt' => $post->description,
                'category' => $post->categorie?->libelle,
                'date' => $post->created_at?->locale('fr')->translatedFormat('d F Y'),
            ]);

        $services = CategorieService::orderBy('id','asc')->take(4)->get(['id','libelle','icone','desc']);

        $projets = Actualite::where('categorie_id', 2)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn ($projet) => [
                'titre' => $projet->titre,
                'slug' => $projet->slug,
                'image' => $projet->image,
                'excerpt' => $projet->description,
                'category' => $projet->categorie?->libelle,
                'date' => $projet->created_at?->locale('fr')->translatedFormat('d F Y'),
        ]);

        $events = Event::latest()
            ->take(3)
            ->get()
            ->map(fn ($event) => [
                'titre' => $event->titre,
                'image' => $event->image,
                'status' => $event->status == "a_venir" ? 'à venir': 'cloturer',
                'date' => $event->date?->locale('fr')->translatedFormat('d F Y')
            ]);


        $documents = Document::with('categorieDocument')
            ->latest()
            ->take(4)
            ->get()
            ->map(fn ($document) => [
                'titre' => $document->titre,
                'fichier' => $document->fichier,
                'category' => $document->categorieDocument?->nom,
                'date' => $document->created_at?->locale('fr')->translatedFormat('d F Y'),
        ]);


        return Inertia::render('Home', [
            'flashs' => $flashs,
            'posts' => $posts,
            'services' => $services,
            'projets' => $projets,
            'documents' => $documents,
            'events' => $events
        ]);
    }

}

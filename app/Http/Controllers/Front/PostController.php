<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Actualite::with('categorie:id,libelle')
            ->when($request->search, fn ($query, $search) => $query->where(
                fn ($sub) => $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('contenu', 'like', "%{$search}%")
            ))
            ->when($request->category, fn ($query, $category) => $query->whereHas(
                'categorie',
                fn ($c) => $c->where('libelle', $category)
            ))
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($post) => $this->toCard($post));

        return Inertia::render('Actualites/Index', [
            'posts' => $posts,
            'categories' => Categorie::orderBy('libelle')->pluck('libelle')->take(7),
            'filters' => (object) $request->only('search', 'category'),
        ]);
    }

    public function show(Actualite $post)
    {
        $post->load('categorie:id,libelle');

        return Inertia::render('Actualites/Show', [
            'post' => [
                'titre' => $post->titre,
                'image' => $post->image,
                'content' => $post->contenu,
                'category' => $post->categorie?->libelle,
                'date' => $post->created_at?->locale('fr')->translatedFormat('d F Y'),
            ],
            'related' => Actualite::with('categorie:id,libelle')
                ->where('id', '!=', $post->id)
                ->latest()
                ->take(3)
                ->get()
                ->map(fn ($item) => $this->toCard($item)),
        ]);
    }

    private function toCard(Actualite $post): array
    {
        return [
            'titre' => $post->titre,
            'slug' => $post->slug,
            'image' => $post->image,
            'contenu' => $post->contenu,
            'excerpt' => $post->description,
            'category' => $post->categorie?->libelle,
            'date' => $post->created_at?->locale('fr')->translatedFormat('d F Y'),
        ];
    }
}

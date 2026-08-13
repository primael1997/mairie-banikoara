<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $news = Actualite::latest()->take(3)->get(['id','titre']);

        $posts = Actualite::latest()->take(3)->get(['id','titre']);

        return Inertia::render('Home', [
            'news' => $news,
            'posts' => $posts,
        ]);
    }
}

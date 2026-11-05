<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CommuneController extends Controller
{
    public function presentation()
    {
        return Inertia::render('Commune/Presentation');
    }


    public function historique()
    {
        return Inertia::render('Commune/Historique');
    }


    public function arrondissement()
    {
        return Inertia::render('Commune/Arrondissement');
    }


    public function projet()
    {
        return Inertia::render('Commune/Projet');
    }
}

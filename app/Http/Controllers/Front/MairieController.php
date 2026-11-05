<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AncienMaire;
use App\Models\Membre;
use App\Models\MotDuMaire;
use App\Models\SecretariatMembre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MairieController extends Controller
{
    public function maire()
    {
        $mot = MotDuMaire::first();

        return Inertia::render('Mairie/MotDuMaire', [
            'mot' => $mot
        ]);
    }

    public function elus()
    {
        $columns = ['id', 'nom', 'poste', 'photo', 'niveau'];

        $communals = Membre::whereHas('entites', function ($query) {
            $query->where('nom', 'Conseil communal');
        })
            ->orderBy('niveau', 'asc')
            ->get($columns);

        $supervisions = Membre::whereHas('entites', function ($query) {
            $query->where('nom', 'Conseil de Supervision');
        })
            ->orderBy('niveau', 'asc')
            ->get($columns);

        $chefArr = Membre::orderBy('id', 'asc')
            ->where('poste', 'like', '%chef d\'arrondissement%')
            ->get($columns);

        $cabinets = Membre::whereHas('entites', function ($query) {
            $query->where('nom', 'Cabinet du Maire');
        })
            ->orderBy('niveau', 'asc')
            ->get($columns);


        return Inertia::render('Mairie/ElusMunicipaux', [
            'communals' => $communals,
            'supervisions' => $supervisions,
            'chefArr' => $chefArr,
            'cabinets' => $cabinets,
        ]);
    }

    public function executif()
    {
        $secretariats = SecretariatMembre::
            orderBy('niveau','asc')
            ->get();

        return Inertia::render('Mairie/Secretariat', [
            'secretariats' => $secretariats
        ]);
    }

    public function anciensMaires()
    {
        $anciens_maires = AncienMaire::orderBy('id','desc')->get(['id','nom','mandat','photo']);

        return Inertia::render('Mairie/Mandature', [
            'anciens_maires' => $anciens_maires
        ]);
    }

    public function organigramme()
    {
        return Inertia::render('Mairie/Organigramme');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entite;
use Illuminate\Http\Request;
use App\Models\Membre; // On suppose qu'on aura une table "membres"

class OrganigrammeController extends Controller
{
  public function index(Request $request)
{
    $entites = Entite::orderBy('nom')->get();

    $query = Membre::with(['entites' => function($q) {
        $q->orderBy('nom');
    }])->orderBy('niveau')->orderBy('ordre');

    if ($request->has('entite') && $request->entite != '') {
        $query->whereHas('entites', function($q) use ($request) {
            $q->where('entites.id', $request->entite);
        });
    }

    $groupes = $query->get()->groupBy('niveau');

    return view('mespages.lemaireelus', compact('groupes', 'entites'));
}
}

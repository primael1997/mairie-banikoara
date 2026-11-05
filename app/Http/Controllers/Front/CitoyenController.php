<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\NouvelleRequeteMail;
use App\Models\CategorieDocument;
use App\Models\Document;
use App\Models\EmailSetting;
use App\Models\Requete;
use App\Services\MailConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CitoyenController extends Controller
{
    public function requete()
    {
        return Inertia::render('Citoyen/Requete');
    }

    public function store(Request $request, MailConfig $mailConfig)
    {
        $data = $request->validate([
            'type' => 'required|in:renseignement,plainte,suggestion',
            'nom' => 'required|string|min:2',
            'email' => 'required|email',
            'telephone' => 'required|string|min:8',
            'sujet' => 'required|string|min:5',
            'message' => 'required|string',
        ]);

        // Numéro de suivi lisible, ex : REQ-20260905-8F3K2
        $numero = 'REQ-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

        $requete = Requete::create([
            ...$data,
            'numero' => $numero,
        ]);

        $setting = EmailSetting::first();

        $mailConfig->configure();

        // Envoi direct à la mairie via Mail::to (synchrone). Si le Mailable
        // implémente ShouldQueue, ça part en file d'attente automatiquement.
        Mail::to($setting->username)
            ->send(new NouvelleRequeteMail($requete));


        return back()->with([
            'success' => true,
            'numero_suivi' => $numero,
        ]);
    }


    public function contact()
    {
        return Inertia::render('Citoyen/Contact');
    }


    public function document(Request $request)
    {
        $categorie = $request->query('categorie', 'tous');
        $recherche = $request->query('recherche');

        $categories = CategorieDocument::query()
            ->orderBy('nom')
            ->get();

        $documents = Document::query()
            ->with('categorieDocument')
            ->when(
                $categorie !== 'tous',
                function ($query) use ($categorie) {
                    $query->whereHas(
                    'categorieDocument',
                    function ($query) use ($categorie) {
                        $query->where(
                            'slug',
                            $categorie
                        );
                    }
                );
            }
        )
        ->when(
            $recherche,
            function ($query) use ($recherche) {
                $query->where(
                    'titre',
                    'like',
                    '%' . $recherche . '%'
                );
            }
        )
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Document/Index',[
                'documents' => $documents,
                'categories' => $categories,
                'filters' => [
                    'categorie' => $categorie,
                    'recherche' => $recherche,
                ],

            ]
        );
    }
}

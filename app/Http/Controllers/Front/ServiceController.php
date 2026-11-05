<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CategorieService;
use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = CategorieService::orderBy('id','desc')
            ->get(['id','libelle','icone','direction','desc','delai']);

        return Inertia::render('Services/Index', [
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $services = Service::with('categorie:id,libelle')
            ->where('categorie_service_id', $id)
            ->orderBy('id','desc')
            ->get()
            ->map(fn ($service) => $this->toCard($service));

        return Inertia::render('Services/Tarif', [
            'services' => $services
        ]);
    }

    private function toCard(Service $service): array
    {
        return [
            'titre' => $service->titre,
            'description' => $service->description,
            'category' => $service->categorie?->libelle,
            'cout' => $service->cout
        ];
    }

}

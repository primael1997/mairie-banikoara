<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\CategorieService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{


    public function index()
    {
        $services = \App\Models\Service::with('categorie')->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function frontendIndex(Request $request)
    {
        // Récupération de toutes les catégories
        $categories = CategorieService::all();

        // Construction de la requête dynamique
        $services = Service::with('categorie')
            ->when($request->filled('categorie'), function ($query) use ($request) {
                $query->where('categorie_service_id', $request->categorie);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('titre', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString(); // pour conserver les filtres pendant la pagination

        // Affichage de la vue avec pagination
        return view('mespages.servicedelamairie', compact('services', 'categories'));
    }

    public function detailService($id)
    {
        // Récupère le service avec sa catégorie
        $service = Service::with('categorie')->findOrFail($id);

        // Récupère 3 services similaires (même catégorie)
        $servicesSimilaires = Service::where('categorie_service_id', $service->categorie_service_id)
                                    ->where('id', '!=', $id)
                                    ->take(3)
                                    ->get();

        return view('services.detail', compact('service', 'servicesSimilaires'));
    }

    public function create()
    {
        $categories = CategorieService::orderBy('id','desc')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|min:3|unique:services,titre',
            'description' => 'required',
            'cout' => 'required|numeric|min:0',
            'pieces_fournir' => 'required|string',
            'categorie_service_id' => 'required|exists:categorie_services,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['titre']);

        $imagePath = $this->uploadImage($request, 'image', 'uploads');
        $validated['image'] = $imagePath;

        Service::create($validated);

        return redirect()->route('admin.services.index');
        toastr('Service ajouté avec succès.','success');
    }


    public function edit(Service $service)
    {
        $categories = CategorieService::all();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'titre' => 'required|min:3|unique:services,titre,' . $service->id,
            'description' => 'required',
            'cout' => 'required|numeric|min:0',
            'pieces_fournir' => 'required|string',
            'categorie_service_id' => 'required|exists:categorie_services,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $service = Service::findOrFail($service);

        $validated['slug'] = Str::slug($validated['titre']);

        $imagePath = $this->updateImage($request, 'photo', 'uploads', $service->image);
        $validated['image'] = $imagePath;

        $service->update($validated);

        toastr('Service modifié avec succès.','success');

        return redirect()->route('admin.services.index');
    }


    public function destroy(Service $service)
    {
        $service = Service::findOrFail($service);
        $this->deleteImage($service->image);
        $service->delete();

        return response(['status' => 'success', 'message' => 'Service supprimé!']);
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

}

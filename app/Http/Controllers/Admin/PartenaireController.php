<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::all();
        return view('admin.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        return view('admin.partenaires.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'site_web' => 'nullable|url',
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'uploads/partenaire');
        $data['logo'] = $imagePath;

        Partenaire::create($data);

        toastr('Partenaire ajouté avec succès.','success');
        return redirect()->route('partenaires.index');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('admin.partenaires.edit', compact('partenaire'));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'site_web' => 'nullable|url',
        ]);

        $partenaire = Partenaire::findOrFail($partenaire);

        $imagePath = $this->updateImage($request, 'image', 'uploads/partenaire', $partenaire->logo);

        $data['logo'] = empty(!$imagePath) ? $imagePath : $partenaire->logo;

        $partenaire->update($data);

        toastr('Partenaire modifié avec succès.','success');
        return redirect()->route('partenaires.index');
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire = Partenaire::findOrFail($partenaire);
        $this->deleteImage($partenaire->logo);
        $partenaire->delete();

        return response(['status' => 'success', 'message' => 'Partenaire supprimée!']);
    }

}

<?php

namespace App\Http\Controllers\Admin;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AncienMaire;
use Illuminate\Support\Facades\Storage;

class AncienMaireController extends Controller
{
     /**
     * Affiche les détails d’un ancien maire spécifique.
     */
    public function show($id)
    {
        $maire = AncienMaire::findOrFail($id);

        return view('public.anciens_maires.show', compact('maire'));
    }

    public function index()
    {
        $anciens_maires = AncienMaire::latest()->orderBy('id','desc')->paginate(10);

        return view('admin.anciens_maires.index', compact('anciens_maires'));
    }

    public function create()
    {
        return view('admin.anciens_maires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'mandat' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biographie' => 'nullable|string',
        ]);

        $data = $request->only(['nom', 'fonction', 'mandat', 'biographie']);

        $imagePath = $this->uploadImage($request, 'photo', 'uploads/anciens_maires');

        $data['photo'] = $imagePath;

        AncienMaire::create($data);

        toastr('Anciens Maire ajouté avec succès','success');
        return redirect()->route('admin.anciens_maires.index');
    }


    public function edit($id)
    {
        $anciens_maires = AncienMaire::findOrFail($id);

        return view('admin.anciens_maires.edit', compact('anciens_maires'));
    }

    public function update(Request $request, $id)
    {
        $anciens_maires = AncienMaire::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'mandat' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'biographie' => 'nullable|string',
        ]);

        $data = $request->only(['nom', 'fonction', 'mandat', 'biographie']);

        $imagePath = $this->updateImage($request, 'image', 'uploads/anciens_maires', $anciens_maires->photo);

        $data['photo'] = $imagePath;

        $anciens_maires->update($data);

        toastr('Anciens Maire modifié avec succès','success');
        return redirect()->route('admin.anciens_maires.index');
    }


    public function destroy($id)
    {
        $maire = AncienMaire::findOrFail($id);
        $this->deleteImage($maire->photo);
        $maire->delete();

        return response(['status' => 'success', 'message' => 'Ancien Maire supprimée!']);
    }
}


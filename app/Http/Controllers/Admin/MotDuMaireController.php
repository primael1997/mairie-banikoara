<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MotDuMaire;
use Illuminate\Support\Facades\Storage;

class MotDuMaireController extends Controller
{
    public function edit()
    {
        // Récupère ou crée automatiquement une entrée vide
        $mot = MotDuMaire::firstOrCreate([]);

        return view('admin.mot-du-maire.edit', compact('mot'));
    }



    public function update(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'titre' => 'nullable|string|max:255',
            'message_1' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);


        $mot = MotDuMaire::first();

        $imagePath = $this->updateImage($request, 'image', 'uploads/photo', $mot->photo);

        $data['photo'] = empty(!$imagePath) ? $imagePath : $mot->photo;

        $mot->update($data);

        toastr('Mot du Maire mis à jour avec succès.','success');

        return redirect()->back();

    }
}

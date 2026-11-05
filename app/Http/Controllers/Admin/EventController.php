<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;


class EventController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $events = Event::orderBy('id','desc')->paginate(10);

        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required','string','max:255',
            'date' => 'required','date',
            'image' => 'required','image',
            'status' => 'required','string','max:255',
        ]);

        $event = new Event();

        $image = $this->uploadImage($request, 'image', 'uploads/actualites');

        $event->titre = $request->titre;
        $event->date = $request->date;
        $event->image = $image;
        $event->status = $request->status;

        $event->save();

        toastr('evenement ajouté avec succès','success');
        return redirect()->route('admin.evenements.index');
    }

    public function edit($id)
    {
        $event =Event::findOrFail($id);

        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required','string','max:255',
            'date' => 'required','date',
            'image' => 'nullable','image',
            'status' => 'required','string','max:255',
        ]);

        $event = Event::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads/actualites', $event->image);

        $event->titre = $request->titre;
        $event->date = $request->date;
        $event->image = empty(!$imagePath) ? $imagePath : $event->image;;
        $event->status = $request->status;

        $event->save();

        toastr('evenement modifié avec succès','success');
        return redirect()->route('admin.evenements.index');
    }

    public function destroy($id)
    {
        $event = Event::where('id',$id)->first();
        $this->deleteImage($event->image);
        $event->delete();

        return response(['status' => 'success', 'message' => 'Evenement supprimée!']);
    }
}

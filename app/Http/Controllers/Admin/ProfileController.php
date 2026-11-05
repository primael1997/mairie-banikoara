<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
       $request->validate([
        'name' => ['required', 'max:100'],
        'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
        'image' => ['image', 'max:2048']
       ]);


       $user = Auth::user();

       $user->name = $request->name;
       $user->email = $request->email;
       $user->save();

       toastr()->success('Profile Updated Successfully!');
       return redirect()->back();
    }

    /** Update Password */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required','confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Mot de passe modifié avec succès. Veuillez vous reconnecter.');

        return redirect()->route('admin.login');
    }
}

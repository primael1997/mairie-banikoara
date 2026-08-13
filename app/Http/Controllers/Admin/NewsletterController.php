<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create(['email' => $request->email]);

        return back()->with('success', 'Merci pour votre inscription !');
    }

    public function sendForm()
    {
        return view('admin.newsletter.send');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $emails = Newsletter::pluck('email');

        foreach ($emails as $email) {
            Mail::raw($request->message, function ($message) use ($email, $request) {
                $message->to($email)
                        ->subject($request->subject);
            });
        }

        return back()->with('success', 'Newsletter envoyée avec succès.');
    }
}

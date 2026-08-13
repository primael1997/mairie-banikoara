<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('frontend.formulairecontact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'type_demande' => 'required|in:plainte,suggestion,renseignement,autre',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'required|string|max:500',
            'objet' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'website' => 'max:0', // Honeypot anti-spam
        ]);

        // Supprimer le honeypot des données
        unset($validated['website']);

        // Ajouter des métadonnées
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        // Sauvegarder en base de données
        $contact = Contact::create($validated);

        // Préparer les données pour l'email
        $emailData = $request->only([
            'type_demande', 'nom', 'prenom', 'email', 'telephone',
            'adresse', 'objet', 'message'
        ]);

        // Définir les destinataires admin
        $adminEmails = [
            'germain7g@gmail.com' // Utiliser seulement l'email qui fonctionne pour l'instant
        ];

        $emailsSent = 0;
        $emailErrors = [];

        try {
            // Envoi aux administrateurs
            foreach ($adminEmails as $adminEmail) {
                try {
                    Mail::to($adminEmail)->send(new ContactFormMail($emailData, false, $contact->id));
                    $emailsSent++;
                    Log::info("Email envoyé avec succès à {$adminEmail} pour le contact #{$contact->id}");
                } catch (\Exception $e) {
                    $emailErrors[] = "Erreur envoi à {$adminEmail}: " . $e->getMessage();
                    Log::error("Erreur envoi email admin à {$adminEmail}: " . $e->getMessage());
                }
            }

            // Copie à l'expéditeur - désactivé temporairement pour éviter les erreurs
            // try {
            //     Mail::to($request->email)->send(new ContactFormMail($emailData, true, $contact->id));
            //     $emailsSent++;
            //     Log::info("Email de confirmation envoyé à {$request->email} pour le contact #{$contact->id}");
            // } catch (\Exception $e) {
            //     $emailErrors[] = "Erreur envoi confirmation: " . $e->getMessage();
            //     Log::error("Erreur envoi email confirmation à {$request->email}: " . $e->getMessage());
            // }

            // Message de succès simple
            $message = 'Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.';

        } catch (\Exception $e) {
            // Erreur générale
            Log::error('Erreur générale envoi email contact: ' . $e->getMessage());
            $message = 'Votre message a été enregistré. Nous vous répondrons dans les plus brefs délais.';
        }

        // Rediriger vers la même page avec le message
        return redirect()->back()->with('success', $message);
    }
}

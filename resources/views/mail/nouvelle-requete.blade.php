@component('mail::message')
# Nouvelle requête citoyenne — {{ ucfirst($requete->type) }}

**Numéro de suivi :** {{ $requete->numero }} <br>

**De :** {{ $requete->nom }} <br>
**Email :** {{ $requete->email }} <br>
**Téléphone :** {{ $requete->telephone }} <br>

**Sujet :** {{ $requete->sujet }} <br>

**Message :**

{{ $requete->message }}

Reçue le {{ $requete->created_at->format('d/m/Y à H:i') }}.

Mairie de Banikoara
@endcomponent

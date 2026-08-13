<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_demande',
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'objet',
        'message',
        'statut',
        'priorite',
        'assigne_a',
        'notes_internes',
        'reponse',
        'date_reponse',
        'date_traitement',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'date_reponse' => 'datetime',
        'date_traitement' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relation avec l'utilisateur assigné
     */
    public function assigneTo()
    {
        return $this->belongsTo(User::class, 'assigne_a');
    }

    /**
     * Récupérer le nom complet
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Récupérer le libellé du type de demande
     */
    public function getTypeDemandeLibelleAttribute()
    {
        $types = [
            'plainte' => 'Plainte',
            'suggestion' => 'Suggestion',
            'renseignement' => 'Renseignement',
            'autre' => 'Autre demande'
        ];

        return $types[$this->type_demande] ?? 'Non défini';
    }

    /**
     * Récupérer le libellé du statut
     */
    public function getStatutLibelleAttribute()
    {
        $statuts = [
            'nouveau' => 'Nouveau',
            'en_cours' => 'En cours',
            'traite' => 'Traité',
            'archive' => 'Archivé'
        ];

        return $statuts[$this->statut] ?? 'Non défini';
    }

    /**
     * Récupérer la couleur du statut
     */
    public function getStatutCouleurAttribute()
    {
        $couleurs = [
            'nouveau' => 'primary',
            'en_cours' => 'warning',
            'traite' => 'success',
            'archive' => 'secondary'
        ];

        return $couleurs[$this->statut] ?? 'secondary';
    }

    /**
     * Récupérer le libellé de la priorité
     */
    public function getPrioriteLibelleAttribute()
    {
        $priorites = [
            'basse' => 'Basse',
            'normale' => 'Normale',
            'haute' => 'Haute',
            'urgente' => 'Urgente'
        ];

        return $priorites[$this->priorite] ?? 'Normale';
    }

    /**
     * Récupérer la couleur de la priorité
     */
    public function getPrioriteCouleurAttribute()
    {
        $couleurs = [
            'basse' => 'success',
            'normale' => 'info',
            'haute' => 'warning',
            'urgente' => 'danger'
        ];

        return $couleurs[$this->priorite] ?? 'info';
    }

    /**
     * Vérifier si le contact est nouveau
     */
    public function isNouveau()
    {
        return $this->statut === 'nouveau';
    }

    /**
     * Vérifier si le contact est en cours
     */
    public function isEnCours()
    {
        return $this->statut === 'en_cours';
    }

    /**
     * Vérifier si le contact est traité
     */
    public function isTraite()
    {
        return $this->statut === 'traite';
    }

    /**
     * Marquer comme traité
     */
    public function marquerTraite($reponse = null)
    {
        $this->update([
            'statut' => 'traite',
            'date_traitement' => now(),
            'reponse' => $reponse
        ]);
    }

    /**
     * Assigner à un utilisateur
     */
    public function assignerA($userId)
    {
        $this->update([
            'assigne_a' => $userId,
            'statut' => 'en_cours'
        ]);
    }

    /**
     * Scope pour les nouveaux contacts
     */
    public function scopeNouveau($query)
    {
        return $query->where('statut', 'nouveau');
    }

    /**
     * Scope pour les contacts en cours
     */
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    /**
     * Scope pour les contacts traités
     */
    public function scopeTraite($query)
    {
        return $query->where('statut', 'traite');
    }

    /**
     * Scope pour filtrer par type de demande
     */
    public function scopeType($query, $type)
    {
        return $query->where('type_demande', $type);
    }

    /**
     * Scope pour filtrer par priorité
     */
    public function scopePriorite($query, $priorite)
    {
        return $query->where('priorite', $priorite);
    }

    /**
     * Scope pour rechercher
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where(function($q) use ($terme) {
            $q->where('nom', 'LIKE', "%{$terme}%")
              ->orWhere('prenom', 'LIKE', "%{$terme}%")
              ->orWhere('email', 'LIKE', "%{$terme}%")
              ->orWhere('objet', 'LIKE', "%{$terme}%")
              ->orWhere('message', 'LIKE', "%{$terme}%");
        });
    }

    /**
     * Scope pour ordonner par priorité
     */
    public function scopeOrderByPriorite($query)
    {
        return $query->orderByRaw("FIELD(priorite, 'urgente', 'haute', 'normale', 'basse')");
    }
}

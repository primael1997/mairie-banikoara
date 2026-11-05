<?php

namespace App\Policies;

use App\Models\Actualite;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActualitePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Actualite $actualite): bool
    {
        return $user->isAdmin === 1 || $user->role === 1;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Actualite $actualite): bool
    {
        return $user->isAdmin === 1 || $user->role === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Actualite $actualite): bool
    {
        return $user->isAdmin === 1 || $user->role === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Actualite $actualite): bool
    {
        return $user->isAdmin === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Actualite $actualite): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Actualite $actualite): bool
    {
        return false;
    }
}

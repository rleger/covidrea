<?php

namespace App\Policies;

use App\User;
use App\Etablissement;
use Illuminate\Auth\Access\HandlesAuthorization;

class EtablissementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any etablissements.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the etablissement.
     *
     * @return mixed
     */
    public function view(User $user, Etablissement $etablissement)
    {
    }

    /**
     * Determine whether the user can create etablissements.
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can create a service for the etablissement.
     *
     * @return mixed
     */
    public function createService(User $user, Etablissement $etablissement)
    {
        return $etablissement->user_id == $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the etablissement.
     *
     * @return mixed
     */
    public function update(User $user, Etablissement $etablissement)
    {
        return  $etablissement->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the etablissement.
     *
     * @return mixed
     */
    public function delete(User $user, Etablissement $etablissement)
    {
    }

    /**
     * Determine whether the user can restore the etablissement.
     *
     * @return mixed
     */
    public function restore(User $user, Etablissement $etablissement)
    {
    }

    /**
     * Determine whether the user can permanently delete the etablissement.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Etablissement $etablissement)
    {
    }
}

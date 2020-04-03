<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Define user's ability to admin the app
     *
     */
    public function administer(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Only a user with an etablissement can invite others
     *
     * @param User $user
     */
    public function invite(User $user) {
        return $user->hasEtablissement();
    }

    /**
     * Only an admin can create an etablissement
     *
     * @param User $user
     */
    public function createEtablissement(User $user)
    {
        return $user->isAdmin();
    }
}

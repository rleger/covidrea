<?php

namespace App\Policies;

use App\User;
use App\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any services.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the service.
     *
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can create services.
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the service.
     *
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        return $user->services()->get()->contains($service->id) || $service->etablissement->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the service.
     *
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
        return $service->etablissement->user_id == $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the service.
     *
     * @return mixed
     */
    public function restore(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can permanently delete the service.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Service $service)
    {
    }
}

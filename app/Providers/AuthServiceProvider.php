<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // only authorize service editing when the service actually belongs to the logged-in user
        Gate::define('edit-service', function ($user, $service) {
            $authorized = $user->services()->get()->contains($service->id);
            Log::info("Is user " . $user->id . " authorized to edit service " . $service->id . " => " . $authorized);
            return $authorized;
        });

        // only authorize etablissement editing when the logged-in user is responsible for this etablissement
        Gate::define('edit-etablissement', function ($user, $etablissement) {
            $authorized = $etablissement->user_id == $user->id;
            Log::info("Is user " . $user->id . " authorized to edit etablissement " . $etablissement->id . " => " . $authorized);
            return $authorized;
        });
    }
}

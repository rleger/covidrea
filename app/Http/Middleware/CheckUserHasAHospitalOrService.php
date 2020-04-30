<?php

namespace App\Http\Middleware;

use Log;
use Closure;

class CheckUserHasAHospitalOrService
{
    /**
     * Check that a user is attached to a service.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->check()) {
            return redirect('/');
        }
        if (! auth()->user()->services()->exists() && ! auth()->user()->etablissement()->exists()) {
            Log::error('User '.auth()->user()->id.' has no service and no etablissement cannot go further');
            // Logout
            auth()->logout();

            // Send home
            return redirect('/');
        }

        return $next($request);
    }
}

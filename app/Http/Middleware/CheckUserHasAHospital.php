<?php

namespace App\Http\Middleware;

use Log;
use Closure;

class CheckUserHasAHospital
{
    /**
     * Check that a user is attached to a service
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->services()->exists()) {
            Log::error("User " . auth()->user()->id . " has no service and cannot go further");
            // Logout
            auth()->logout();

            // Send home
            return redirect('/');
        }

        return $next($request);
    }
}

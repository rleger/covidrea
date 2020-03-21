<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Show a list of services
     *
     * @param User $user
     */
    public function show(User $user)
    {
        // Attention get() doit être ici dans la chaine
        $services = $user->services()
                         ->with('etablissement')
                         ->get()
                         ->groupBy(['etablissement_id']);

        return view('user.service.show', compact('services'));
    }
}

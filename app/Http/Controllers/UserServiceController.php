<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Edit the number of available beds for the user
     *
     * @param User $user
     */
    public function edit(User $user)
    {
        // Attention get() doit être ici dans la chaine
        $services = $user->services()
                         ->with('etablissement')
                         ->get()
                         ->groupBy(['etablissement_id']);

        return view('user.service.edit', compact('services'));
    }
}

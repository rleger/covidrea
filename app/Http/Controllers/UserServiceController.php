<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkuserhasahospital');
    }

    /**
     * Edit the number of available beds for the user
     *
     * @param User $user
     */
    public function edit()
    {
        // Attention get() doit être ici dans la chaine
        $services = auth()->user()->services()
                         ->with('etablissement')
                         ->get()
                         ->groupBy(['etablissement_id']);

        return view('user.service.edit', compact('services'));
    }
}

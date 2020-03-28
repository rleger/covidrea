<?php

namespace App\Http\Controllers;

use App\User;
use App\Etablissement;
use Illuminate\Support\Facades\Gate;

class UserEtablissementController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $etablissements = auth()->user()->etablissement;

        return view('user.etablissement.index', compact('etablissements'));
    }

    public function edit(User $user, Etablissement $etablissement)
    {
        Gate::authorize('edit-etablissement', $etablissement);

        $services = $etablissement->services;

        return view('user.etablissement.edit', compact('etablissement', 'services'));
    }


    public function update(User $user, Etablissement $etablissement)
    {
        Gate::authorize('edit-etablissement', $etablissement);

    }
}

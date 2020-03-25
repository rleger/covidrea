<?php

namespace App\Http\Controllers;

use App\User;
use App\Etablissement;

class UserEtablissementController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        $etablissements = $user->etablissement;

        return view('user.etablissement.index', compact('etablissements'));
    }

    public function edit(User $user, Etablissement $etablissement)
    {
        $services = $etablissement->services;

        return view('user.etablissement.edit', compact('etablissement', 'services'));
    }


    public function update(User $user, Etablissement $etablissement)
    {
    }
}

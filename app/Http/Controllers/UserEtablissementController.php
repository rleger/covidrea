<?php

namespace App\Http\Controllers;

use App\User;
use App\Etablissement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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


    public function update(Request $request, User $user, Etablissement $etablissement)
    {
        Gate::authorize('edit-etablissement', $etablissement);
        Log::info("About to update etablissement " . $etablissement->id);

        $request->session()->flash('etablissement_id', $etablissement->id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        // Model update
        $etablissement->update($validatedData);

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status' => 'Nombre de lits mis à jour',
        ]);
    }
}

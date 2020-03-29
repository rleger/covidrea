<?php

namespace App\Http\Controllers;

use App\Etablissement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Log;

class UserEtablissementController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a list of Etablissement to choose from.
     */
    public function index()
    {
        $etablissements = auth()->user()->etablissement;

        return view('user.etablissement.index', compact('etablissements'));
    }

    /**
     * Show the edit form.
     */
    public function edit(User $user, Etablissement $etablissement)
    {
        Gate::authorize('edit-etablissement', $etablissement);

        $services = $etablissement->service;

        return view('user.etablissement.edit', compact('etablissement', 'services'));
    }

    /**
     * Update the user.
     */
    public function update(Request $request, User $user, Etablissement $etablissement)
    {
        Gate::authorize('edit-etablissement', $etablissement);
        Log::info('About to update etablissement '.$etablissement->id);

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

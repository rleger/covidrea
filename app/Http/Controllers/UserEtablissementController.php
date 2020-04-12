<?php

namespace App\Http\Controllers;

use Log;
use App\User;
use App\Etablissement;
use Illuminate\Http\Request;

class UserEtablissementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $this->authorize('update', $etablissement);

        $services = $etablissement->service;

        return view('user.etablissement.edit', compact('etablissement', 'services'));
    }

    /**
     * Update the user.
     */
    public function update(Request $request, User $user, Etablissement $etablissement)
    {
        $this->authorize('update', $etablissement);
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
                'status_etablissement' => "L'établissement à été mis à jour.",
            ]);
    }
}

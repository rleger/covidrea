<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Etablissement;

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
     * Edit the number of available beds for the user.
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

    public function store(Request $request)
    {
        // Find Etablissement to attach the service to
        $etablissement = Etablissement::findOrFail($request->get('etablissement_id'));

        // Check user has permissions
        Gate::authorize('create-service', $etablissement);

        // Validate the request
        $validatedData = $request->validate([
            'name'          => 'required|string',
            'place_totales' => 'integer|nullable',
        ]);

        // Force casting place totales to int so null => 0
        $validatedData['place_totales'] = (int) $validatedData['place_totales'];

        // Create the service linked to $etablissement
        $etablissement->service()->create($validatedData);

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status_service' => 'Service ajouté',
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Service;
use App\Etablissement;
use Illuminate\Http\Request;

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
    }

    /**
     * Edit the number of available beds for the user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        // We will need the service_id to display success or error message in the
        // right form
        $request->session()->flash('service_id', $service->id);

        // Validation
        $validatedData = $request->validate([
            'place_totales'            => ['required', 'integer',
            function ($attribute, $value, $fail) {
                // Le nombre de place totales ne peut exceder la somme des 2 autres
                if (((int) request()->get('place_disponible') + (int) request()->get('place_bientot_disponible')) > (int) $value) {
                    $fail('Le nombre de places totales ne peut pas exceder la somme des places disponibles et bientôt disponibles');
                }
            }, ],
            'place_disponible'         => 'required|integer',
            'place_bientot_disponible' => 'required|integer',
        ]);

        // Model update
        $service->update($validatedData);

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status' => 'Nombre de lits mis à jour',
            ]);
    }

    /**
     * Create a new service attached to an etablissement.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        // Find Etablissement to attach the service to
        $etablissement = Etablissement::findOrFail($request->get('etablissement_id'));

        // Check user has permissions
        $this->authorize('createService', $etablissement);

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

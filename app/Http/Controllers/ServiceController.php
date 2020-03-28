<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
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
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        Gate::authorize('edit-service', $service);

        // We will need the service_id to display success or error message in the
        // right form
        $request->session()->flash('service_id', $service->id);

        // Validation
        $validatedData = $request->validate([
            'place_totales'            => ['required', 'integer',
            function($attribute, $value, $fail) {
                // Le nombre de place totales ne peut exceder la somme des 2 autres
                if(((int) request()->get('place_disponible') + (int) request()->get('place_bientot_disponible')) > (int) $value) {
                    $fail("Le nombre de places totales ne peut pas exceder la somme des places disponibles et bientôt disponibles");
                }
            }],
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
}

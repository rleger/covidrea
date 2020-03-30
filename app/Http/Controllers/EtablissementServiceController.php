<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Etablissement;

class EtablissementServiceController extends Controller
{
    /**
     * Create a new service attached to an etablissement
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        // Find Etablissement to attach the service to
        $etablissement = Etablissement::findOrFail($request->get('etablissement_id'));

        // We will need the service_id to display success or error message in the
        // right form
        $request->session()->flash('etablissement_id', $etablissement->id);

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
                'etablissement_id' => $etablissement->id,
            ]);
    }
}

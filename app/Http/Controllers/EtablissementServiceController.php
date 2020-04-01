<?php

namespace App\Http\Controllers;

use App\Etablissement;
use Illuminate\Http\Request;

class EtablissementServiceController extends Controller
{
    /**
     * You need to be authenticated to access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new service attached to an etablissement.
     */
    public function store(Request $request)
    {
        // Find Etablissement to attach the service to
        $etablissement = Etablissement::findOrFail($request->get('etablissement_id'));

        // We will need the service_id to display success or error message in the
        // right form
        $request->session()->flash('etablissement_id', $etablissement->id);

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
                'status_service'   => 'Service ajouté',
                'etablissement_id' => $etablissement->id,
            ]);
    }
}

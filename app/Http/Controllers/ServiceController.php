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
     * Show edit page.
     */
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        // We will need the service_id to display success or error message in the
        // right form
        $request->session()->flash('service_id', $service->id);

        // Validation
        $validatedData = $request->validate([
            'name'    => 'required',
            'contact' => 'required',
        ]);

        // Model update
        $service->update($validatedData);

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status' => 'Service mis à jour',
            ]);
    }

    /**
     * Delete a service.
     */
    public function delete(Service $service)
    {
        // Check user has permissions
        $this->authorize('delete', $service);

        // @todo: do not allow deletion of the last service of an etablissement
        //
        // Delete service
        $service->delete();

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status_deleted' => 'Service effacé',
            ]);
    }
}

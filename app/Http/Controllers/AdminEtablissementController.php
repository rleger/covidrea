<?php

namespace App\Http\Controllers;

use App\Etablissement;
use Illuminate\Http\Request;

class AdminEtablissementController extends Controller
{
    /**
     * List of etablissements.
     */
    public function index()
    {
        // @todo: pagination
        $etablissements = Etablissement::orderBy('created_at', 'DESC')->get();

        return view('admin.etablissement.index', compact('etablissements'));
    }

    /**
     * Invite new users.
     */
    public function invite(Etablissement $etablissement)
    {
        return view('admin.etablissement.invite', compact('etablissement'));
    }

    /**
     * Create an etablissement.
     */
    public function create()
    {
        return view('admin.etablissement.create');
    }

    /**
     * Stores an etablissement.
     */
    public function store(Request $request)
    {
        $this->authorize('createEtablissement', auth()->user());

        // Validation
        $validatedData = $request->validate([
            'name'        => 'required',
            'type'        => 'required',
            'adresse'     => 'required',
            'codepostal'  => 'required',
            'ville'       => 'required|alpha_spaces',
            'pays'        => 'required',
            'region'      => 'required',
            'lat'         => 'required',
            'long'        => 'required',
        ]);

        // Model creation
        $etablissement = Etablissement::create($validatedData);

        // Back to the view
        return back()
            ->withInput()
            ->with([
                'status' => "Etablissement $etablissement->name crée",
            ]);
    }

    /**
     * Edit an etablissement.
     */
    public function edit()
    {
    }
}

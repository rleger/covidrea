<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etablissement;

class AdminEtablissementController extends Controller
{
    /**
     * List of etablissements
     */
    public function index()
    {
        // @todo: pagination
        $etablissements = Etablissement::orderBy('created_at', 'DESC')->get();

        return view('admin.etablissement.index', compact('etablissements'));
    }

    /**
     * Invite new users
     *
     * @param Etablissement $etablissement
     */
    public function invite(Etablissement $etablissement)
    {
        return view('admin.etablissement.invite', compact('etablissement'));
    }

    /**
     * Create an etablissement
     */
    public function create()
    {
        return view('admin.etablissement.create');
    }

    /**
     * Stores an etablissement
     */
    public function store(Request $request)
    {
        dd($request->all());
        return back()->with([
            'status' => "Etablissement ajouté",
        ]);
    }

    /**
     * Edit an etablissement
     */
    public function edit()
    {
        //
    }
}

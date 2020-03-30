<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InviteCreated;
use App\Service;
use App\Etablissement;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $radius = request()->query('radius', 20);
        $places = [];

        // Etablissement est soit la liste des établissements des services de l'utilisateur
        // soit l'établissement pour lequel l'utilisateur est référent (etablissement.user_id)
        if(auth()->user()->services()->count()) {
            // Position of the user's etablissement
            $etablissement = auth()->user()->services()->first()->etablissement;
        } else {
            $etablissement = auth()->user()->etablissement()->first();
        }

        $coordinates = [
            'lat' => $etablissement->lat,
            'long' => $etablissement->long
        ];

        $etablissements_within_radius = Etablissement::select('id')->isWithinMaxDistance($coordinates, $radius)->get()->toArray();

        // Array with places
        $places = [
            'places_totales' => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_totales'),
            'place_disponible' => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_disponible'),
            'place_bientot_disponible' => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_bientot_disponible'),
        ];

        return view('home', compact('places', 'etablissement'));
    }
}

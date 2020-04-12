<?php

namespace App\Http\Controllers;

use App\Service;
use App\Etablissement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private const DEFAULT_RADIUS = 20;

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
        $radius = request()->query('radius', self::DEFAULT_RADIUS);

        // Etablissement est soit la liste des établissements des services de l'utilisateur
        // soit l'établissement pour lequel l'utilisateur est référent (etablissement.user_id)
        if (auth()->user()->services()->count()) {
            // Position of the user's etablissement
            $etablissement = auth()->user()->services()->first()->etablissement;
        } else {
            $etablissement = auth()->user()->etablissement()->first();
        }

        $places = $this->getPlaces($radius, $etablissement);

        return view('home', compact('places', 'etablissement'));
    }

    /**
     * Get places status in Etablissement within a radius.
     *
     * @param Etablissement $etablissement
     */
    private function getPlaces(int $radius, Etablissement $etablissement = null): array
    {
        if (null === $etablissement) {
            return [];
        }

        $coordinates = [
            'lat'  => $etablissement->lat,
            'long' => $etablissement->long,
        ];

        $etablissements_within_radius = Etablissement::select('id')->isWithinMaxDistance($coordinates, $radius)->get();

        $etablissements_within_radius = $etablissements_within_radius->map(function ($item) {
            return $item['id'];
        });

        return [
            'places_totales'           => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_totales'),
            'place_disponible'         => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_disponible'),
            'place_bientot_disponible' => Service::whereIn('etablissement_id', $etablissements_within_radius)->sum('place_bientot_disponible'),
        ];
    }
}

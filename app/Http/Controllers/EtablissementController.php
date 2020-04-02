<?php

namespace App\Http\Controllers;

use DB;
use App\Etablissement;


class EtablissementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // The user needs either to have a hospital or to have services
        // (that are linked to hospitals)
        $this->middleware('checkuserhasahospitalorservice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $etablissements = Etablissement::with('service')->withCount('service')->get();

        // Etablissement est soit la liste des établissements des services de l'utilisateur
        // soit l'établissement pour lequel l'utilisateur est référent (etablissement.user_id)
        if (auth()->user()->services()->count()) {
            // Position of the user's etablissement
            $etablissement = auth()->user()->services()->first()->etablissement;
        } else {
            $etablissement = auth()->user()->etablissement()->first();
        }

        $lat = $etablissement->lat;
        $lon = $etablissement->long;

        $etablissements = Etablissement::hydrate(DB::select(
            'select max(service.updated_at) as last_service_update, 
                etablissements.*,
                ( 6371 * acos( cos( radians(:lat) )
                * cos( radians( etablissements.lat ) )
                * cos( radians( etablissements.long )
                - radians(:lon) )
                + sin( radians(:lat_2) )
                * sin( radians( etablissements.lat ) ) ) ) as distance
                from etablissements
                join services service on etablissements.id = service.etablissement_id
                group by etablissements.id
            ', ['lat' => $lat, 'lat_2' => $lat, 'lon' => $lon]));

        // return the view
        return view('etablissement.index', compact('etablissements'));
    }

    /**
     * Show etablissement.
     */
    public function show(Etablissement $etablissement)
    {
        return view('etablissement.show', compact('etablissement'));
    }
}

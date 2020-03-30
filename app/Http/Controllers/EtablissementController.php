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
        $long = $etablissement->long;

        // Construct the sqlDistance query
        $sqlDistance = DB::raw('( 6371 * acos( cos( radians('.$lat.') )
            * cos( radians( etablissements.lat ) )
            * cos( radians( etablissements.long )
            - radians('.$long.') )
            + sin( radians('.$lat.') )
            * sin( radians( etablissements.lat ) ) ) )');

        // Construct the service count query
        // SELECT *, (SELECT count(*) FROM services WHERE services.etablissement_id=etablissements.`id`) AS cnt FROM etablissements
        $sqlCount = DB::raw('( SELECT count(*) FROM services WHERE services.etablissement_id=etablissements.`id` )');

        $sqlPlace = DB::raw('( SELECT sum(place_disponible) + sum(place_bientot_disponible) FROM services WHERE services.etablissement_id=etablissements.`id` )');

        // Run the query
        $paginator = DB::table('etablissements')
            ->select('etablissements.*')
            ->selectRaw("{$sqlDistance} AS distance, {$sqlCount} as service_count, {$sqlPlace} as places")
            // ->orderBy('service_count', 'DESC')
            // ->orderBy('places', 'DESC')
            ->orderBy('distance', 'ASC')
            ->paginate(10);

        // https://laracasts.com/discuss/channels/laravel/hydraterawfromquery-with-pagination
        $etablissements = Etablissement::hydrate($paginator->items());

        // return the view
        return view('etablissement.index', compact('etablissements', 'paginator'));
    }

    /**
     * Show etablissement.
     */
    public function show(Etablissement $etablissement)
    {
        return view('etablissement.show', compact('etablissement'));
    }
}

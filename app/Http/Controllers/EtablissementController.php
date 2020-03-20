<?php

namespace App\Http\Controllers;

use App\Etablissement;
use DB;

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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $etablissements = Etablissement::with('service')->withCount('service')->get();

        // Position of the user's etablissement
        $etablissement = auth()->user()->services()->first()->etablissement;
        $lat = $etablissement->lat;
        $long = $etablissement->long;

        // Construct the sqlDistance query
        $sqlDistance = DB::raw('( 111.045 * acos( cos( radians('.$lat.') )
            * cos( radians( etablissements.lat ) )
            * cos( radians( etablissements.long )
            - radians('.$long.') )
            + sin( radians('.$lat.') )
            * sin( radians( etablissements.lat ) ) ) )');

        // Run the query
        $paginator = DB::table('etablissements')
            ->select('etablissements.*')
            ->selectRaw("{$sqlDistance} AS distance")
            ->orderBy('distance', 'ASC')
            ->paginate(10);

        // https://laracasts.com/discuss/channels/laravel/hydraterawfromquery-with-pagination
        $etablissements = Etablissement::hydrate($paginator->items());

        return view('etablissement.index', compact('etablissements', 'paginator'));
    }
}

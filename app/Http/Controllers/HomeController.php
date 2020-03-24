<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InviteCreated;
use App\Service;

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
        $places = [];

        $places['places_totales'] = Service::sum('place_totales');
        $places['place_disponible'] = Service::sum('place_disponible');
        $places['place_bientot_disponible'] = Service::sum('place_bientot_disponible');

        return view('home', compact('places'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserServiceController extends Controller
{
    public function show(User $user)
    {
        // Attention get() doit être ici dans la chaine
        $services = $user->services()
                         ->with('etablissement')
                         ->get()
                         ->groupBy(['etablissement_id']);
        // $services = $user->services()->with('etablissement')->get();
        // dd($services->first()->etablissement);
        // $etablissement = $services->map(
            // function ($item, $key) {
                // return $item->etablissement;
            // })->unique('id');

        // $etablissement = $services->map(
            // function ($item, $key) {
                // dd($item->first()->etablissement);
                // // return $item->etablissement;
            // })->unique('id');

        $all = $services->all();
        // dd(get_class_methods($all[1]));
        // dd($all[11][0]->name);



        // dd($services, $etablissements);
        // return view('user.service.show', compact('services', 'etablissement'));
        return view('user.service.show', compact('services'));
    }
}

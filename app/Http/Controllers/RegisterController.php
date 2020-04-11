<?php

namespace App\Http\Controllers;

use App\User;
use App\Prospect;
use App\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
    }

    public function register(Prospect $prospect)
    {
        return view('register.form', compact('prospect'));
    }

    public function process(Request $request)
    {
        Validator::make($request->all(), [
            'etab_name'                      => 'required|alpha_spaces|max:80',
            'etab_type'                      => 'required',
            'etab_adresse'                   => 'required',
            'etab_codepostal'                => 'required',
            'etab_ville'                     => 'required',
            'etab_region'                    => 'required',
            'etab_long'                      => 'required',
            'etab_lat'                       => 'required',
            'user_name'                      => 'required|alpha_spaces|max:50',
            'user_email'                     => 'required|email:rfc,dns|unique:users,email',
            'user_phone'                     => 'required|phone:FR,mobile',
            'password'                       => 'required|same:password_confirm',
            'password_confirm'               => 'required',
            'prospect'                       => 'required'
        ])->validate();

        $prospectId = $request->get('prospect');
        $prospect = Prospect::findOrFail($prospectId);
        $prospect->active = 0;
        $prospect->save();

        // Create User
        $user = User::create([
            'name'         => $request->get('user_name'),
            'email'        => $request->get('user_email'),
            'phone_mobile' => $request->get('user_phone'),
            'password'     => bcrypt($request->get('password')),
        ]);

        Etablissement::updateOrCreate(
            ['prospect_id' => $prospectId],
            [
                'name'       => $request->get('etab_name'),
                'type'       => $request->get('etab_type'),
                'adresse'    => $request->get('etab_adresse'),
                'codepostal' => $request->get('etab_codepostal'),
                'ville'      => $request->get('etab_ville'),
                'region'     => $request->get('etab_region'),
                'long'       => $request->get('etab_long'),
                'lat'        => $request->get('etab_lat'),
                'user_id'    => $user->id
            ]
        );

        // Log the user in
        auth()->login($user);

        // return the view
        return redirect()->route('invite');
    }
}

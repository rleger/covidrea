<?php

namespace App\Http\Controllers;

use App\Etablissement;
use App\Invite;
use App\Jobs\InviteNewUsersByEmail;
use App\User;
use Illuminate\Http\Request;
use Validator;

class InviteController extends Controller
{
    public function __construct()
    {
    }

    /**
     * View where we can invite new users.
     */
    public function invite(User $user)
    {
        $this->middleware('auth');

        $user->load('etablissement');

        return view('invite', compact('user'));
    }

    /**
     * This is called when the administrator submits a list of emails
     */
    public function process(Request $request)
    {
        // extract emails to array
        $emails = $request->get('emails');
        $emails = array_map('trim', explode(',', str_replace(';', ',', $emails)));

        $request->merge(compact('emails'));

        // Validate
        // @todo: improve error message
        // @todo: limit the number of emails
        Validator::make($request->all(), [
            'emails.*'      => 'required|email',
            'etablissement' => 'required|exists:etablissements,id',
        ])->validate();

        // @todo: remove emails that exists either in user or invite class
        // Create Invite with a token
        InviteNewUsersByEmail::dispatch($request->all());

        // redirect back where we came from
        return back()
            ->with([
                'status' => "Les invitations sont en cours d'envoi, nous vous enverrons une confirmation par email.",
            ]);
    }

    /**
     * here we'll look up the user by the token sent provided in the URL *.
     *
     * @param mixed $token
     */
    public function accept($token, $etablissement_id)
    {
        $etablissement = Etablissement::with('service')->findOrFail($etablissement_id);

        $services = $etablissement->service;

        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // The user will fill in the missing fields (name, etc..)
        return view('invite.finalize', compact('etablissement', 'services', 'token'));
    }

    /**
     * Une fois que l'utilisateur a saisi les informations.
     */
    public function finalize(Request $request)
    {
        // Such a mess I'm ashamed.. pleasssse clean this up !!

        // Validate the request
        Validator::make($request->all(), [
            'name'                           => 'required|alpha_dash|max:20',
            'email'                          => 'required|email:rfc,dns|unique:users,email',
            'phone_mobile'                   => 'phone:FR,mobile',
            'password'                       => 'required|same:password_confirm',
            'password_confirm'               => 'required',
            'service'                        => 'required',
        ])->validate();

        $inputs = $request->all();

        // Create the user
        $user = User::create([
            'name'              => ucfirst(strtolower($inputs['name'])),
            'email'             => strtolower($inputs['email']),
            'phone_mobile'      => $inputs['phone_mobile'],
            'password'          => bcrypt($inputs['password']),
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        // Attach the user to the services selected
        $services = array_keys($inputs['service']);

        $user->services()->attach($services);

        // delete the invite so it can't be used again
        // Look up the invite
        if ($invite = Invite::where('token', $inputs['token'])->first()) {
            $invite->delete();
        }

        // Log the user in
        auth()->login($user);

        // return the view
        return redirect()->route('home');
    }
}

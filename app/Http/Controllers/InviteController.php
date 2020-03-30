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
        $this->middleware('auth')->except('finalize');
    }

    /**
     * View where we can invite new users.
     */
    public function invite(User $user)
    {
        $user->load('etablissement', 'etablissement.service');

        return view('invite', compact('user'));
    }

    /**
     * This is called when the administrator submits a list of emails
     */
    public function process(Request $request, Etablissement $etablissement)
    {
        // extract emails to array
        $emails = $request->get('emails');
        $request->merge(["unprocessed_emails" => $emails]);

        // Extract all emails with their name
        // @see https://stackoverflow.com/questions/14010875/extract-email-and-name-with-regex#answer-48890442
        \preg_match_all('/(?:("?(?:.*)"?)\s)?<(.*@.*)>|(.*@.*)/', $emails, $return, PREG_SET_ORDER, 0);

        // emailNames array will use unique email as index, and value will be name if found or null
        $emailNames = [];
        foreach($return as $r) {
            $email = $name = null;
            if (isset($r[3])) {
                $email = $r[3];
            } else {
                $email = $r[2];
                $name = trim(trim($r[1], '"'));
            }

            $email = trim(trim(trim(mb_strtolower($email)), ',;'));
            if (!isset($emailNames[$email]) || !$emailNames[$email]) {
                // If not set or without a name
                $emailNames[$email] = $name;
            }
        }

        // For now, just use email address, names aren't saved
        $emails = array_keys($emailNames);

        // Set both var to let check on simple emails var
        $request->merge(compact('emails'));
        $request->merge(compact('emailNames'));

        // Allow to display error messages in the right place when there are more than 1 form
        $request->session()->flash('form', 'invite');
        $request->session()->flash('etablissement_id', $request->get('etablissement'));

        // Validate
        // @todo: improve error message
        // @todo: limit the number of emails
        $validator = Validator::make($request->all(), [
            'emails.*'      => 'required|email',
            'etablissement' => 'required|exists:etablissements,id',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->with(['unprocessed_emails' => $request->get('unprocessed_emails') ])
                        ->withInput();
        }

        // Create Invite with a token
        InviteNewUsersByEmail::dispatch($request->all());

        // redirect back where we came from
        return back()
            ->with([
                'status_invitation' => "Les invitations sont en cours d'envoi, nous vous enverrons une confirmation par email.",
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
            'name'                           => 'required|alpha_dash|max:30',
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

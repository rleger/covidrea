<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Invite;
use App\Etablissement;
use Illuminate\Http\Request;
use App\Jobs\InviteNewUsersByEmail;

class InviteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['process']);

        $this->middleware('checkuseradministersahospital')->only('invite');
    }

    /**
     * View where we can invite new users.
     */
    public function invite()
    {
        $user = auth()->user();

        $user->load('etablissement', 'etablissement.service');

        return view('invite', compact('user'));
    }

    /**
     * This is called when the administrator submits a list of emails.
     */
    public function process(Request $request, Etablissement $etablissement)
    {
        // extract emails to array
        $emails = $request->get('emails');
        $request->merge(['unprocessed_emails' => $emails]);

        $emails = array_map('trim', explode(',', str_replace(';', ',', $emails)));

        // Ne fonctionne pas
        // preg_match_all("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $emails, $return);
        // $emails = array_unique($return[0]);

        $request->merge(compact('emails'));

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
                        ->with(['unprocessed_emails' => $request->get('unprocessed_emails')])
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
            abort(403, "Cette invitation n'existe pas");
        }

        // If invite is not active do not allow the invitation to go through
        if (!$invite->active) {
            abort(403, "Cette invitation a déjà été utilisée");
        }

        // The user will fill in the missing fields (name, etc..)
        return view('invite.finalize', compact('invite', 'etablissement', 'services', 'token'));
    }

    /**
     * Une fois que l'utilisateur a saisi les informations.
     */
    public function finalize(Request $request)
    {
        // Such a mess I'm ashamed.. pleasssse clean this up !!

        // Validate the request
        Validator::make($request->all(), [
            'nom'                            => 'required|alpha_spaces|max:50',
            'rpps'                           => 'required|integer|exists:professionnels|unique:users',
            'email'                          => 'required|email:rfc,dns|unique:users,email',
            'phone_mobile'                   => 'phone:FR,mobile',
            'password'                       => 'required|same:password_confirm',
            'password_confirm'               => 'required',
            'service'                        => 'required',
        ])->validate();

        $inputs = $request->all();

        // Create the user
        $user = User::create([
            'name'              => ucfirst(strtolower($inputs['nom'])),
            'rpps'              => $inputs['rpps'],
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
            $invite->active = 0;
            $invite->save();
            // $invite->delete();
        }

        // Log the user in
        auth()->login($user);

        // return the view
        return redirect()->route('user.services.edit');
    }
}

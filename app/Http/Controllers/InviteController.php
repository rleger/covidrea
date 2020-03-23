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
        $this->middleware('auth');
    }

    /**
     * View where we can invite new users.
     */
    public function invite(User $user)
    {
        $user->load('etablissement');

        return view('invite', compact('user'));
    }

    /**
     * validate the incoming request data *.
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
        $validator = Validator::make($request->all(), [
            'emails.*' => 'required|email',
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
        // dd($etablissement->toArray());
        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // The user will fill in the missing fields (name, etc..)
        return view('invite.finalize', compact('etablissement', 'services'));
    }

    public function finalize()
    {
        // create the user with the details from the invite
        User::create(['email' => $invite->email]);

        // delete the invite so it can't be used again
        $invite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return 'Good job! Invite accepted!';
    }
}

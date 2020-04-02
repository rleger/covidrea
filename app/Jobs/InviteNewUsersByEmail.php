<?php

namespace App\Jobs;

use App\Etablissement;
use Str;
use Mail;
use App\Invite;
use App\Mail\InviteCreated;
use Illuminate\Bus\Queueable;
use App\Events\EmailWasSentToInvite;
use App\Mail\InvitationConfirmation;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InviteNewUsersByEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Emails
     *
     * @var array
     */
    protected $request;

    protected $emails;

    protected $etablissement_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;

        $this->emails = $request['emails'];

        $this->etablissement_id = $request['etablissement'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Creating the Invite models
        foreach ($this->emails as $email) {
            $this->createInviteModel($email);
        }

        // once all the invitation emails have been sent, send a confirmation email to the etablissement user
        $this->sendConfirmationEmail();
    }

    /**
     * Create new Invites from their email
     *
     * @param mixed $email
     */
    protected function createInviteModel($email)
    {
        //generate a random string using Laravel's str_random helper
        do {
            $token = Str::random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'email' => $email,
            'etablissement_id' => $this->etablissement_id,
            'token' => $token
        ]);

        $this->sendInvitationEmail($invite);

    }

    /**
     * Send the emails to the invitee
     *
     * @param mixed $invite
     */
    protected function sendInvitationEmail($invite)
    {
        // send the email
        Mail::to($invite->email)->send(new InviteCreated($invite));

        // Emit an event once an email has been sent
        event(new EmailWasSentToInvite($invite));
    }

    /**
     * Send a confirmation email to the etablissement owner
     *
     * @param mixed $invite
     */
    protected function sendConfirmationEmail()
    {
        // send the email
        $user = Etablissement::find($this->etablissement_id)->user();
        Mail::to($user->email)->send(new InvitationConfirmation($this->etablissement_id, $this->emails));
    }
}

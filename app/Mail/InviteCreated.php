<?php

namespace App\Mail;

use App\Invite;
use App\Etablissement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $etablissement_name = Etablissement::FindOrFail($this->invite->etablissement_id)->name;

        $mailgunVariables = json_encode([
            'type' => 'invite',
            'name' => 'initial invite',
            'id'   => $this->invite->id,
        ]);

        $subject = "$etablissement_name vous invite à rejoindre COVID moi un lit";

        $this->withSwiftMessage(function ($message) use ($mailgunVariables) {
            $message->getHeaders()
                    ->addTextHeader('X-Mailgun-Variables', $mailgunVariables);
        });

        return $this->from(config('covidrea.email.default_sender'), config('covidrea.email.default_sender_name'))
                    ->subject($subject)
                    ->markdown('emails.invite');
    }
}

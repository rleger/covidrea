<?php

namespace App\Mail;

use App\Invite;
use App\Etablissement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $emails;
    public $etablissement_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($etablissement_id, array $emails)
    {
        $this->etablissement_id = $etablissement_id;
        $this->emails = $emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailgunVariables = json_encode([
            'type' => 'invitation_confirmation',
            'name' => 'invitation confirmation',
            'id'   => $this->etablissement_id,
        ]);

        $subject = "Vos invitations à rejoindre COVID moi un lit";

        $this->withSwiftMessage(function ($message) use ($mailgunVariables) {
            $message->getHeaders()
                    ->addTextHeader('X-Mailgun-Variables', $mailgunVariables);
        });

        return $this->from(config('covidrea.email.default_sender'), config('covidrea.email.default_sender_name'))
                    ->subject($subject)
                    ->markdown('emails.invitation_confirmation');
    }
}

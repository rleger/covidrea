<?php

namespace App\Mail;

use App\Etablissement;
use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

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

        $subject = "L'établissement $etablissement_name vous invite à rejoindre COVID moi un lit";

        return $this->from(config('covidrea.email.default_sender'))
                    ->subject($subject)
                    ->markdown('emails.invite');
    }
}

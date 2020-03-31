<?php

namespace App\Mail;

use App\Prospect;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProspectInvite extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $prospect;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Prospect $prospect)
    {
        $this->prospect = $prospect;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $etablissement_name = $this->prospect->etab_name;

        $subject = "Gestion de lits de réanimation  ($etablissement_name)";

        return $this->from(config('covidrea.email.default_sender'), config('covidrea.email.default_sender_name'))
                    ->subject($subject)
                    ->markdown('emails.prospect');
    }
}

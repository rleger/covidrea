<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Prospect;

class ProspectInvite extends Mailable
{
    use Queueable, SerializesModels;

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

        $subject = "Invitation de $etablissement_name à rejoindre Covid moi un lit";

        return $this->from(config('covidrea.email.default_sender'))
                    ->subject($subject)
                    ->markdown('emails.prospect');
    }
}

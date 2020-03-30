<?php

namespace App\Listeners;

use App\Prospect;
use App\Events\EmailWasSentToProspect;

class RecordEmailToProspect
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(EmailWasSentToProspect $event)
    {
        \Log::info('Email sent to : '.$event->prospect->user_email);
    }
}

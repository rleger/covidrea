<?php

namespace App\Listeners;

use App\Events\EmailWasSentToProspect;
use App\ProspectNotification;
use Log;

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
        // Record a prospect notificiation
        ProspectNotification::create([
            'type'        => 'email',
            'name'        => 'initial invite',
            'prospect_id' => $event->prospect->id,
        ]);

        Log::info('Email sent to : '.$event->prospect->user_email);
    }
}

<?php

namespace App\Listeners;

use Log;
use App\ProspectNotification;
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
        // Record a prospect notificiation
        ProspectNotification::create([
            'type'            => 'email',
            'name'            => 'initial invite',
            'feedback'        => 'sent',
            'prospect_id'     => $event->prospect->id,
        ]);

        Log::info('Email sent to : '.$event->prospect->user_email);
    }
}

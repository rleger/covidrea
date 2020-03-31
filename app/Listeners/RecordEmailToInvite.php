<?php

namespace App\Listeners;

use App\Events\EmailWasSentToInvite;
use App\InviteNotification;
use Log;

class RecordEmailToInvite
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
    public function handle(EmailWasSentToInvite $event)
    {
        // Record a invite notificiation
        InviteNotification::create([
            'type'        => 'email',
            'name'        => 'initial invite',
            'invite_id'   => $event->invite->id,
        ]);

        Log::info('Email sent to : '.$event->invite->user_email);
    }
}

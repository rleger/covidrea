<?php

namespace App\Events;

use App\Invite;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EmailWasSentToInvite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Invite object
     *
     * @var mixed
     */
    public $invite;

    /**
     * Create a event instance
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }
}

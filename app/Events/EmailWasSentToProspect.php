<?php

namespace App\Events;

use App\Prospect;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EmailWasSentToProspect
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Prospect object
     *
     * @var mixed
     */
    public $prospect;

    /**
     * Create a event instance
     *
     * @return void
     */
    public function __construct(Prospect $prospect)
    {
        $this->prospect = $prospect;
    }
}

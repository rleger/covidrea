<?php

namespace App\Events;

use App\Invite;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class EmailWasSentToInvite
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Invite object.
     *
     * @var mixed
     */
    public $invite;

    /**
     * Create a event instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }
}

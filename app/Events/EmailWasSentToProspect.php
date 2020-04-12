<?php

namespace App\Events;

use App\Prospect;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class EmailWasSentToProspect
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Prospect object.
     *
     * @var mixed
     */
    public $prospect;

    /**
     * Create a event instance.
     *
     * @return void
     */
    public function __construct(Prospect $prospect)
    {
        $this->prospect = $prospect;
    }
}

<?php

namespace App\Jobs;

use Log;
use App\InviteNotification;
use App\ProspectNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RecordMailgunWebhook implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // If there is no type var defined in the mail don't do anything
        if (!in_array('type', $this->request['event-data']['user-variables'])) {
            Log::info("If there is no type var defined in the mail don't do anything");

            return;
        }

        // Get the type
        $type = $this->request['event-data']['user-variables']['type'];
        Log::info("type: $type");

        // define the recorders
        $recorder = [
            'prospect' => ProspectNotification::class,
            'invite'   => InviteNotification::class,
        ];

        if (!in_array($type, $recorder)) {
            Log::info("From RecordMailgunWebhook no logger corresponding to type $type");

            return;
        }

        // Find a handler
        $handler = $recorder[$type];
        Log::info("handler : $handler");

        // name of id
        $name_id = $type.'_id';

        // Create the object
        $recorded = $handler::firstOrCreate([
            $name_id   => $this->request['event-data']['user-variables']['id'],
            'type'     => 'email',
            'name'     => $this->request['event-data']['user-variables']['name'],
            'feedback' => $this->request['event-data']['event'],
        ]);
        Log::info("created" . print_r($recorded, true));
    }
}

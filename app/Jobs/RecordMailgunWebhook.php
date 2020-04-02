<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\ProspectNotification;
use App\InviteNotification;

class RecordMailgunWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        if(!in_array('type', $this->request['event-data']['user-variables'])) {
            return;
        }

        // Get the type
        $type = $this->request['event-data']['user-variables']['type'];


        // define the recorders
        $recorder = [
            'prospect' => ProspectNotification::class,
            'invite'   => InviteNotification::class,
        ];

        if(!in_array($type, $recorder)) {
            \Log::info("From RecordMailgunWebhook no logger corresponding to type $type");
            return;
        }

        // Find a handler
        $handler = $recorder[$type];

        // name of id
        $name_id = $type.'_id';

        // Create the object
        $handler::firstOrCreate([
            $name_id   => $this->request['event-data']['user-variables']['id'],
            'type'     => 'email',
            'name'     => $this->request['event-data']['user-variables']['name'],
            'feedback' => $this->request['event-data']['event'],
        ]);
    }
}

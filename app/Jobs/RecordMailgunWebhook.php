<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\ProspectNotification;
use App\InviteNotification;
use App\Prospect;
use App\Invite;

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
            \Log::info("From RecordMailgunWebhook missing type information");
            return;
        }

        // Get the type
        $type = $this->request['event-data']['user-variables']['type'];

        // Define the recorders
        $recorder = [
            'prospect' => ProspectNotification::class,
            'invite'   => InviteNotification::class,
        ];
        $objectClasses = [
            'prospect' => Prospect::class,
            'invite'   => Invite::class,
        ];

        // Find the handler
        if(!in_array($type, $recorder)) {
            \Log::info("From RecordMailgunWebhook no logger corresponding to type $type");
            return;
        }
        $handler = $recorder[$type];
        $objectClass = $objectClasses[$type];

        // foreign key
        $name_id = $type.'_id';
        $id = $this->request['event-data']['user-variables']['id'];

        // Check the notification still exists in DB
        if (!$objectClass::find($id)) {
            \Log::info("From RecordMailgunWebhook no notification corresponding to object $type id $id");
            return;
        }

        // Create the object
        $handler::firstOrCreate([
            $name_id   => $id,
            'type'     => 'email',
            'name'     => $this->request['event-data']['user-variables']['name'],
            'feedback' => $this->request['event-data']['event'],
        ]);
    }
}

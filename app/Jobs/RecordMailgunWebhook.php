<?php

namespace App\Jobs;

use Log;
use Exception;
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

    /**
     * Request.
     */
    protected $request;

    /**
     * Set to 8 days (8 x 24 x 60 x 60).
     */
    protected $maxWebhookTimeValidity = 691200;

    /**
     * Correspondance between type and recorder.
     *
     * @var mixed
     */
    protected $recorder = [
        'prospect' => ProspectNotification::class,
        'invite'   => InviteNotification::class,
    ];

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
     * Check the incoming webhook is valid.
     */
    protected function checkHookIsValid()
    {
        // Verify mailgun token
        if (!$this->isFromMailgun($this->request['signature'])) {
            Log::notice('[incoming MG webhook] : invalid signature !');

            return false;
        }

        if ($this->checkHookHasExpired()) {
            Log::notice('[incoming MG webhook] : expired TS, not logging anything');

            return false;
        }

        // Check the payload has a 'type'
        if(!array_key_exists('type', $this->request['event-data']['user-variables'])) {
            Log::notice('[incoming MG webhook] : invalid, missing type field');

            return false;
        }

        return true;
    }

    /**
     * Make sure webhook is not too old (allows throttling if necessary).
     */
    protected function checkHookHasExpired()
    {
        if (array_key_exists('timestamp', $this->request['event-data'])) {
            $ts_hook = $this->request['event-data']['timestamp'];

            // If the hook is older than x days
            return (time() - $ts_hook) > $this->maxWebhookTimeValidity;
        }

        // Default to false to avoid missing records
        return false;
    }

    /**
     * Verify that the request is comming from Mailgun.
     *
     * @param mixed $token
     * @param mixed $timestamp
     * @param mixed $signature
     */
    protected function isFromMailgun($request)
    {
        $apiKey = env('MAILGUN_SECRET');
        $token = $request['token'];
        $timestamp = $request['timestamp'];
        $signature = $request['signature'];

        // Check if the timestamp is fresh
        if (time() - $timestamp > 15) {
            return false;
        }

        // Returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }

    /**
     * Find the object responsible to log the event.
     */
    protected function resolveNotificationClass()
    {
        // Get the type
        $type = $this->request['event-data']['user-variables']['type'];

        // define the recorders
        if (!array_key_exists($type, $this->recorder)) {
            Log::info("From RecordMailgunWebhook no logger corresponding to type $type");

            return;
        }

        return $this->recorder[$type];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->checkHookIsValid()) {
            return;
        }

        // Notification Handler
        $handler = $this->resolveNotificationClass();

        $type = $this->request['event-data']['user-variables']['type'];

        // name of id
        $name_id = $type.'_id';

        // Create the object
        try {
            $recorded = $handler::firstOrCreate([
                $name_id   => $this->request['event-data']['user-variables']['id'],
                'type'     => 'email',
                'name'     => $this->request['event-data']['user-variables']['name'],
                'feedback' => $this->request['event-data']['event'],
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::warning("Cannot log $type notification. $message");
        }
    }
}

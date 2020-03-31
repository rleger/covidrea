<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class WebhookMailgunController extends Controller
{
    public function index(Request $request)
    {
        \Log::info("request : " . print_r($request->all(), true));

        $request = $request->all();
        $signatureArray = $request['signature'];
        // $eventData = $request['eventData'];


        // \Log::info("request " . print_r($request->all(), true));
        //verify mailgun token
        if (!$this->isFromMailgun($signatureArray)) {
            \Log::info("auth failed");
        }


        // $booking_id = $request->get('booking_id');

        $payload = [
            'type'       => 'mail',
            'status'     => $request['event-data']['event'],
            'created_at' => date('Y-m-d H:i:s', $request['event-data']['timestamp']),
        ];
        \Log::info("Nouvel evenement ... " .  print_r($payload, true));

        // dispatch(new RecordBookingCommunication(decodeId($booking_id), $payload));
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
        $token = $request[ 'token' ];
        $timestamp = $request[ 'timestamp' ];
        $signature = $request[ 'signature' ];

        // Check if the timestamp is fresh
        if (time() - $timestamp > 15) {
            return false;
        }

        // Returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }
}

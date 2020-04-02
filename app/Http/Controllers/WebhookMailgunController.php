<?php

namespace App\Http\Controllers;

use App\Jobs\RecordMailgunWebhook;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class WebhookMailgunController extends Controller
{
    public function index(Request $request)
    {
        // \Log::info('request : '.print_r($request->all(), true));
        $request = $request->all();

        //verify mailgun token
        if (!$this->isFromMailgun($request['signature'])) {
            // \Log::info('auth failed');
            throw new UnauthorizedHttpException('Mailgun webhook failed !');
        }

        RecordMailgunWebhook::dispatch($request);
        // \Log::info("Nouvel evenement ... " .  print_r($payload, true));
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
}

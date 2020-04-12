<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\RecordMailgunWebhook;

class WebhookMailgunController extends Controller
{
    /**
     * Record a new webhook.
     */
    public function index(Request $request)
    {
        // Record mailgun webhook
        RecordMailgunWebhook::dispatch($request->all());
    }
}

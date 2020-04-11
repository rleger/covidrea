<?php

namespace App\Http\Controllers;

use App\Jobs\RecordMailgunWebhook;
use Illuminate\Http\Request;

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

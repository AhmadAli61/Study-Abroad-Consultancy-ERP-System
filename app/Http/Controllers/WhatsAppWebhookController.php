<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('WhatsApp Webhook Received', $request->all());
        // Add your WhatsApp handling logic here
        return response('OK', 200);
    }
}
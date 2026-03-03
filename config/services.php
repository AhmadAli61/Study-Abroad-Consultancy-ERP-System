<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // ADD THIS SECTION - META INTEGRATION
    'meta' => [
        'access_token' => env('META_ACCESS_TOKEN'),
        'pixel_id' => env('META_PIXEL_ID'),
        'webhook_verify_token' => env('META_WEBHOOK_VERIFY_TOKEN'),
        'business_id' => env('META_BUSINESS_ID'),
        'page_id' => env('META_PAGE_ID'),
        'page_access_token' => env('META_PAGE_ACCESS_TOKEN'),
        'app_id' => env('META_APP_ID'),
        'app_secret' => env('META_APP_SECRET'),
    ],
    
    'whatsapp' => [
        'token' => env('WHATSAPP_TOKEN'),
        'waba_id' => env('WHATSAPP_WABA_ID'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
    ],

];
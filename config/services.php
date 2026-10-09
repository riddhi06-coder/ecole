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

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],
    
        
   'grayquest' => [
        'base_url' => env('GRAYQUEST_BASE_URL', 'https://erp-api.grayquest.com/v1'),
        'client_id' => env('ERP_CLIENT_ID'),
        'client_secret' => env('ERP_CLIENT_SECRET'),
        'api_key' => env('ERP_API_KEY'),
        'webhook_base_url' => env('GRAYQUEST_WEBHOOK_BASE_URL'),
    ],
    
    'razorpay' => [
        'key'    => env('RAZORPAY_KEY'),
        'secret' => env('RAZORPAY_SECRET'),
    ],



];

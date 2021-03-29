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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID', config('siteSetting.google_client_id')),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', config('siteSetting.google_client_secret')),
        'redirect'      => env('APP_URL').'/social-login/google/callback',
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID', config('siteSetting.facebook_client_id')),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', config('siteSetting.facebook_client_secret')),
        'redirect'      => env('APP_URL').'/social-login/facebook/callback',
    ],

    'twitter' => [
        'client_id'     => env('TWITTER_CLIENT_ID', config('siteSetting.twitter_client_id')),
        'client_secret' => env('TWITTER_CLIENT_SECRET', config('siteSetting.twitter_client_secret')),
        'redirect'      => env('APP_URL').'/social-login/twitter/callback',
    ],

];

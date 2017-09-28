<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'github' => [
        'client_id' => '2a52ea44836b4a61c299',
        'client_secret' => 'c36ad61371c2310841697bc8291428f7b5907e5a',
        'redirect' => 'https://www.njphper.com/callback/github',
    ],
    
    'sina'    => [
        'client_id' => '2644609239',
        'client_secret' => 'facd89924c04df05b9706de512c8583c',
        'redirect'  => 'https://www.njphper.com/callback/sina',
    ],
    
    'qq'  => [
        'client_id' => '101266314',
        'client_secret' => '9ed76763891e5cab36f992d4239a5cab',
        'redirect'  => 'https://www.njphper.com/callback/qq',
    ],
    
    'oauth' => [
        'driver'   => ['qq', 'sina', 'github',],
        'password' => 'njphper.com',
    ]

];

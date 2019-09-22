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

    'qiniu' => [
        'ak' => env('QINIU_AK'),
        'sk' => env('QINIU_SK'),
        'bucket' => env('QINIU_BUCKET'),
        'domain' => [
            'default' => env('QINIU_DEFAULT_DOMAIN'),
            'custom' => env('QINIU_CUSTOM_DOMAIN'),
            'https' => env('QINIU_HTTPS_DOMAIN'),
        ]
    ],

    'geetest' => [
        'id' => env('GEETEST_ID'),
        'key' => env('GEETEST_KEY'),
    ]

];

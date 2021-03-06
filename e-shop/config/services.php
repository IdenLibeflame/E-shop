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

    'facebook' => [
        'client_id' => '1928739714058865',
        'client_secret' => '743e00ec6ba1a2f70744f9deae496fba',
        'redirect' => 'http://laratest.app/login/callback/facebook',
    ],

    'twitter' => [
        'client_id' => 'AAVUN5ufjfQ2zq81JCVHQU1yq',
        'client_secret' => 'evKUkdDZv1dIZv3qfM9aIXsXfIdLP3Rz0jx6ElUhK0Mdrgv755',
        'redirect' => 'http://laratest.app/login/callback/twitter',
    ],

    'vkontakte' => [
        'client_id' => '6207439',
        'client_secret' => 'pR1eOFGG8EstJaeTS2ml',
        'redirect' => 'http://laratest.app/login/callback/vkontakte',
    ],

];

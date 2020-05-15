<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*'],

    'allowed_methods' => ['GET', 'POST', 'PATCH', 'PUT', 'OPTIONS'],

    'allowed_origins' => [
        'https://test.com',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Origin', 'Content-Type', 'Cookie', 'X-CSRF-TOKEN', 'Accept', 'Authorization', 'X-XSRF-TOKEN'],

    'exposed_headers' => ['Authorization', 'authenticated'],

    'max_age' => 0,

    'supports_credentials' => true,

];

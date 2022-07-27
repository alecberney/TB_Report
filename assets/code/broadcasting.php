<?php

return [

    [...]

    'default' => env('BROADCAST_DRIVER', 'null'),

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => env('LARAVEL_WEBSOCKETS_TLS', false),
                'encrypted' => env('LARAVEL_WEBSOCKETS_ENCRYPTED', false),
                'host' => env('LARAVEL_WEBSOCKETS_HOST', '127.0.0.1'),
                'port' => env('LARAVEL_WEBSOCKETS_PORT', 6001),
                'scheme' => env('LARAVEL_WEBSOCKETS_SCHEME', 'http'),
                'curl_options' => [
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ],
            ],
        ],
    ]

    [...]
];

<?php

return [

    'defaults' => [
        'guard' => 'api', // Define guard for API
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'keycloak', // Define keycloak as API guard
            'provider' => 'users',
        ],
    ],
];

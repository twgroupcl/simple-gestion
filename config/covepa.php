<?php

return [
    'env_production' => env('COVEPA_PRODUCTION'),
    'api_endpoint_prop' => env('COVEPA_ENDPOINT_PROD'),
    'api_endpoint_dev' => env('COVEPA_ENDPOINT_DEV'),

    'credentials' => [
        'user' => env('COVEPA_USER'),
        'password' => env('COVEPA_PASSWORD'),
    ],

    'credentials_dev' => [
        'user' => env('COVEPA_DEV_USER'),
        'password' => env('COVEPA_DEV_PASSWORD'),
    ],
];
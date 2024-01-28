<?php


return [
    'log_format' => env('LOG_REQUEST_FORMAT', 'default'),
    'log_location' => env('LOG_REQUEST_LOCATION', storage_path('logs/request.log')),
];

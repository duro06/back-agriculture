<?php


return [
    'server' => 'swoole',
    'https' => false,
    'host' => '0.0.0.0',
    'port' => 8005,
    'workers' => env('OCTANE_WORKERS', 2),
    'tasks' => env('OCTANE_TASKS', 2),
    'max_requests' => 500,
    'swoole' => [
        'options' => [
            'http_compression' => true,
            'http_compression_level' => 6,
        ],
    ],
];

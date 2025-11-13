<?php
return [
    'reverb_app_id' => env('REVERB_APP_ID', ''),
    'reverb_app_key' => env('REVERB_APP_KEY', ''),
    'reverb_app_secret' => env('REVERB_APP_SECRET', ''),
    'reverb_host' => env('REVERB_HOST', '127.0.0.1'),
    'reverb_port' => env('REVERB_PORT', 8080),
    'reverb_scheme' => env('REVERB_SCHEME', 'http'),
    'channel' => 'debug-triggered'
];

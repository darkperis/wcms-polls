<?php
return [
    'admin_auth' => env('POLL_ADMIN_AUTH_MIDDLEWARE', 'auth'),
    'admin_guard' => env('POLL_ADMIN_AUTH_GUARD', 'web'),
    'pagination' => env('POLL_PAGINATION', 15),
    'prefix' => env('POLL_PREFIX', ''), 
    'results' => '',
    'radio' => '',
    'checkbox' => '',
    'user_model' => App\User::class,
];

<?php
return [
    'default' => env('MAIL_MAILER', 'smtp'),
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ],
    ],
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'aladrysymhmd093@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'laravel app'),
    ],
    'admin_email' => env('ADMIN_EMAIL', 'aladrysymhmd093@gmail.com'),

];

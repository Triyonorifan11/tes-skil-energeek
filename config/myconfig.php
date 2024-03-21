<?php

return [
    'default_password' => env('DEFAULT_PASSWORD', '123456'),
    'SUBPATH_DOMAIN' => env('SUBPATH_DOMAIN', 'disbudpar-tourism'),
    'VITE_INDONESIAN_LANGUAGE_ID' => env('VITE_INDONESIAN_LANGUAGE_ID'),
    'recaptcha_key' => [
        'secret' => env('RECAPTCHA_SECRET_KEY', false),
        'site' => env('RECAPTCHA_SITE_KEY', false),
    ],
];

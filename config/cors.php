<?php

return [

    'paths' => ['api/*'],  // Ensure your API routes are included in CORS handling

    'allowed_methods' => ['*'],  // Allow all methods (POST, GET, etc.)

    'allowed_origins' => ['http://localhost:3000'],  // Your React frontend URL

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],  // Allow all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,  // Set this to true if you need to send cookies/auth tokens
];

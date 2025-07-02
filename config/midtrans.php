<?php

return [
<<<<<<< HEAD
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => false, // true untuk produksi
    'is_sanitized' => true,
    'is_3ds' => true,
=======
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
>>>>>>> 4450d003b90e556c54d346c935dc4d3adcd6af96
];

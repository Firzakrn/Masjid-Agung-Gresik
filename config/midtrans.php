<?php

// config/midtrans.php
// Letakkan file ini di: config/midtrans.php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key
    |--------------------------------------------------------------------------
    | Ambil dari: https://dashboard.midtrans.com → Settings → Access Keys
    | Gunakan Sandbox key saat development, Production key saat live.
    */
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key
    |--------------------------------------------------------------------------
    | Digunakan di frontend (blade) untuk memanggil snap.js
    */
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Mode Production
    |--------------------------------------------------------------------------
    | false = Sandbox (testing), true = Production (live)
    */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
];
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Unleashed API
    |--------------------------------------------------------------------------
    |
    | https://apidocs.unleashedsoftware.com/AuthenticationHelp
    |
    */

    'api_id' => env('UNLEASHED_API_ID', ''),
    'api_key' => env('UNLEASHED_API_KEY', ''),

    // Used in client-type header. Format: partner_name/app_name
    'partner_name' => env('UNLEASHED_PARTNER_NAME', ''),
];

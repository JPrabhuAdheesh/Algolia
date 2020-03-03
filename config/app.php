<?php

/**
 * @category    Produt-service
 * @package     Product Search
 * @author      mAm <prabhu.u@awok.com>
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Algolia 
    |--------------------------------------------------------------------------
    |
    | This value gives, the maximum number of records a request can return
    |
    */
    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
        'api_token' => env('API_TOKEN', ''),



    ],    

];
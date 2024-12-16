<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uploads parameters
    |--------------------------------------------------------------------------
    |
    | Here you may specify uploads parameters.
    |
    */

    'post' => [
        'max_file_size' => env('POST_MAX_FILE_SIZE', 10*1024*1024),
    ],

];

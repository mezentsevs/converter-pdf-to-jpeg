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

    'documents_directory' => env('UPLOADS_DOCUMENTS_DIRECTORY','documents'),
    'post' => [
        'max_file_size' => env('POST_MAX_FILE_SIZE', 10*1024*1024),
    ],

];

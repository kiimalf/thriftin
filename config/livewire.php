<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Customize the temporary file upload settings, including the list of
    | MIME types that are allowed to be previewed in the browser.
    |
    */

    'temporary_file_upload' => [
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
            'avif',
        ],
    ],

];

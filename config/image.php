<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'brand' => [
        'default' => [
            'width' => 500,// 728,
            'height' => 500// 90,
        ]
    ],
    'category' => [
        'default' => [
            'width' => 500,// 728,
            'height' => 500// 90,
        ]
    ],
    'product' => [
        'default' => [
            'width' => 500,// 728,
            'height' => 500// 90,
        ]
    ],

];

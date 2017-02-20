<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Use StaticIO service.
    |--------------------------------------------------------------------------
    |
    | It is possible to disable the use of StaticIO to manage images and
    | static files by changes this sitting to false.
    |
    */

    'activated' => env('STATICIO_ACTIVATED', false),

    /*
    |--------------------------------------------------------------------------
    | StaticIO domain
    |--------------------------------------------------------------------------
    |
    | It is possible to disable the use of StaticIO to manage images and
    | static files by changes this sitting to false.
    |
    */

    'domain' => env('STATICIO_DOMAIN', config('app.url')),

    /*
    |--------------------------------------------------------------------------
    | Image settings
    |--------------------------------------------------------------------------
    |
    | It is possible to disable the use of StaticIO to manage images and
    | static files by changes this sitting to false.
    |
    */

    'grey'       => env('STATICIO_IMAGE_GREY', null),
    'invert'     => env('STATICIO_IMAGE_INVERT', null),
    'blur'       => env('STATICIO_IMAGE_BLUR', null),
    'contrast'   => env('STATICIO_IMAGE_CONTRAST', null),
    'brightness' => env('STATICIO_IMAGE_BRIGHTNESS', null),
    'pixelate'   => env('STATICIO_IMAGE_PIXELATE', null),
    'sharpen'    => env('STATICIO_IMAGE_SHARPEN', null),
    'colorize'   => env('STATICIO_IMAGE_COLORIZE', null),
    'rotate'     => env('STATICIO_IMAGE_ROTATE', null),
    'quality'    => env('STATICIO_IMAGE_QUALITY', 80),

];

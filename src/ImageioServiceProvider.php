<?php

namespace Tlorentzen\ImageIO;

use Illuminate\Support\ServiceProvider;

/**
 * Copyright (C) 2016 Thomas Lorentzen
 */

class ImageioServiceProvider extends ServiceProvider
{
    public function boot() {

        $this->publishes([
            __DIR__ . '/config/imageio.php' => config_path('imageio.php')
        ], 'config');

    }
    public function register() {}
}
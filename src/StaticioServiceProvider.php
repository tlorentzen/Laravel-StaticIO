<?php

namespace Tlorentzen\StaticIO;

use Illuminate\Support\ServiceProvider;

/**
 * Copyright (C) 2017 Thomas Lorentzen
 */

class StaticioServiceProvider extends ServiceProvider
{
    public function boot() {

        $this->publishes([
            __DIR__ . '/config/staticio.php' => config_path('staticio.php')
        ], 'config');

    }
    public function register() {}
}
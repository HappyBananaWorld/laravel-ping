<?php

namespace LaravelPing;

use Illuminate\Support\ServiceProvider;

class LiveDebuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'live-debugger');

        // Publish assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/live-debugger'),
        ], 'public');

        // Publish config
        $this->publishes([
            __DIR__.'/../config/live-debugger.php' => config_path('live-debugger.php'),
        ], 'config');

        // Merge config
        $this->mergeConfigFrom(__DIR__.'/../config/live-debugger.php', 'live-debugger');

        if (file_exists($file = __DIR__.'/helpers.php')) {
            require $file;
        }
    }

    public function register()
    {
        // register bindings if needed
    }
}

<?php

namespace YourVendor\LiveDebugger;

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
    }

    public function register()
    {
        // register bindings if needed
    }
}

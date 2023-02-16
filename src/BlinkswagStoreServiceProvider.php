<?php

namespace Blinkswag\Store;

use Illuminate\Support\ServiceProvider;

class BlinkswagStoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Blinkswag\Store\Http\Controllers\BlinkswagStoreController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'blinkswag_store');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}

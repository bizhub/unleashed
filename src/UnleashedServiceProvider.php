<?php

namespace Bizhub\Unleashed;

use Illuminate\Support\ServiceProvider;

class UnleashedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/unleashed.php' => config_path('unleashed.php'),
            ], 'config');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/unleashed.php', 'unleashed');

        $this->app->singleton(Unleashed::class, function(){
            date_default_timezone_set('NZ');

            return new Unleashed(
                config('unleashed.api_id'),
                config('unleashed.api_key')
            );
        });
    }
}

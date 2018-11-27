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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Unleashed::class, function($app){
            date_default_timezone_set('NZ');

            return new Unleashed(
                env('UNLEASHED_API_ID'),
                env('UNLEASHED_API_KEY')
            );
        });
    }
}
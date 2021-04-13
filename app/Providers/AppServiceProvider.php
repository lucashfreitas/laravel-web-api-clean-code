<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use App\Services\Action\ActionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('actionHandler', function ($app) {
            return new ActionHandler();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Features\Auth\Contracts\ILogoutHandler;
use App\Features\Auth\Contracts\IMeHandler;
use App\Features\Auth\Contracts\ILoginHandler;
use App\Features\Auth\Contracts\ISignupHandler;
use App\Features\Auth\Handlers\LoginHandler;
use App\Features\Auth\Handlers\LogoutHandler;
use App\Features\Auth\Handlers\MeHandler;
use App\Features\Auth\Handlers\SignupHandler;
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

        $this->app->bind(ILogoutHandler::class, LogoutHandler::class);
        $this->app->bind(ISignupHandler::class, SignupHandler::class);
        $this->app->bind(IMeHandler::class, MeHandler::class);
        $this->app->bind(ILoginHandler::class, LoginHandler::class);
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

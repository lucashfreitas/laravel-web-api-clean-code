<?php

namespace App\Providers;

use App\Listeners\Auth\OnAuthenticationFail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use  App\Listeners\Auth\OnUserSuccessfulLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     *
     * @return void
     */
}

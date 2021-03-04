<?php

namespace App\Providers;

use App\Features\Auth\Events\UserRegistered;
use App\Features\Auth\Listeners\OnAuthenticationFailed;
use App\Features\Auth\Listeners\OnUserRegistered;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



use Illuminate\Auth\Events\Login;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [


        Login::class => [
            OnUserSuccessfulLogin::class,
        ],

        Failed::class => [
            OnAuthenticationFailed::class,
        ],


        UserRegistered::class => [
            OnUserRegistered::class,
        ],


    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();
    }
}

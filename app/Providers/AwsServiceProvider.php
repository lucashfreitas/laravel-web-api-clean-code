<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Aws\Sdk;




class AwsServiceProvider extends ServiceProvider
{


    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


        $this->app->singleton('aws', function ($app) {
            $config = $app->make('config')->get('aws');

            return new Sdk($config);
        });

        $this->app->alias('aws', 'Aws\Sdk');
    }
}

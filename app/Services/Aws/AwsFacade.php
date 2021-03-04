<?php


namespace App\Services\Aws;

use Illuminate\Support\Facades\Facade;


class AwsFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'aws';
    }
}

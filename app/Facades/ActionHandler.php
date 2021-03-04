<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ActionHandler extends Facade
{


    /**
     * @method static execute(string $handler, Request $request): \Illuminate\Http\JsonResponse
   
     */
    protected static function getFacadeAccessor()
    {
        return 'actionHandler';
    }
}

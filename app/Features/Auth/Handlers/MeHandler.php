<?php

namespace App\Features\Auth\Handlers;

use App\Core\Handler\RequestHandler;
use App\Core\Action\ActionFactory;
use App\Core\Action\Results\ActionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MeHandler extends RequestHandler
{


    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function handle(): ActionResult
    {
        if (Auth::user()) {
            return ActionFactory::success(Auth::user());
        }
        return ActionFactory::unauthorized(__("auth.unauthenticated"));
    }
}

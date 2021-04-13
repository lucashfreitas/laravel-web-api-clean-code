<?php

namespace App\Features\Auth\Handlers;

use App\Core\Handler\RequestHandler;

use App\Core\Action\ActionFactory;
use App\Core\Action\Results\ActionResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutHandler extends RequestHandler
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function handle(): ActionResult
    {
        Auth::logout();
        return ActionFactory::success();
    }
}

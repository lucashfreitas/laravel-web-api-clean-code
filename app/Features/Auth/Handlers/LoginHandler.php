<?php

namespace App\Features\Auth\Handlers;

use App\Core\Handler\RequestHandler;
use App\Features\Auth\Requests\LoginRequest;
use App\Core\Action\ActionFactory;
use App\Core\Action\Results\ActionResult;
use Illuminate\Support\Facades\Auth;

class LoginHandler extends RequestHandler
{
    public function __construct(LoginRequest  $request) {
        parent::__construct($request);
    }
    public function handle(): ActionResult
    {
        if (Auth::attempt($this->input)) {
            return ActionFactory::success();
        } else {
            return ActionFactory::unauthorized(__("auth.wrong-credentials"));
        }
    }
}

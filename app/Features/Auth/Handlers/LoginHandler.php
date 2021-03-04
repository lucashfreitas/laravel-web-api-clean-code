<?php

namespace App\Features\Auth\Handlers;

use App\Features\Auth\Requests\LoginRequest;
use App\Services\Action\Action;
use App\Services\Action\ActionFactory;
use App\Services\Action\Results\ActionResult;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginHandler extends Action
{

    public function __construct(LoginRequest $request)
    {
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

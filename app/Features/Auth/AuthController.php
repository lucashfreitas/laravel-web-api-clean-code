<?php

namespace App\Features\Auth;

use App\Features\Auth\Contracts\ILogoutHandler;
use App\Facades\ActionHandler;
use App\Features\Auth\Contracts\IMeHandler;
use App\Features\Auth\Contracts\ISignupHandler;
use App\Features\Auth\Contracts\ILoginHandler;
use App\Features\Auth\Requests\LoginRequest;
use App\Features\Auth\Requests\SignupRequest;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    public function signup(SignupRequest $request)
    {
        return ActionHandler::execute(ISignupHandler::class, $request);
    }

    public function login(LoginRequest $request)
    {
        return ActionHandler::execute(ILoginHandler::class, $request);
    }

    public function logout(Request $request)
    {

        return ActionHandler::execute(ILogoutHandler::class, $request);
    }

    public function me(Request $request)
    {
        return ActionHandler::execute(IMeHandler::class, $request);
    }
}

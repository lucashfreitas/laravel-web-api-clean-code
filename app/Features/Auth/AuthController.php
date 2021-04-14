<?php

namespace App\Features\Auth;

use App\Core\Action\ActionHandler;
use App\Features\Auth\Handlers\LoginHandler;
use App\Features\Auth\Handlers\LogoutHandler;
use App\Features\Auth\Handlers\MeHandler;
use App\Features\Auth\Handlers\SignupHandler;
use App\Features\Auth\Requests\LoginRequest;
use App\Features\Auth\Requests\SignupRequest;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    public function signup(SignupRequest $request)
    {
        return ActionHandler::execute(new SignupHandler($request));
    }

    public function login(LoginRequest $request)
    {
        return ActionHandler::execute(new LoginHandler($request));
    }

    public function logout(Request $request)
    {

        return ActionHandler::execute(new LogoutHandler($request));
    }

    public function me(Request $request)
    {
        return ActionHandler::execute(new MeHandler($request));
    }
}

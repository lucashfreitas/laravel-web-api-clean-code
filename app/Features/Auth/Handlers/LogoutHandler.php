<?php

namespace App\Features\Auth\Handlers;

use App\Features\Auth\Contracts\ILogoutHandler;
use App\Features\Auth\Events\UserRegistered;
use App\Features\Auth\Requests\LoginRequest;
use App\Models\User;
use App\Services\Action\Action;
use App\Services\Action\ActionFactory;
use App\Services\Action\Results\ActionResult;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LogoutHandler extends Action implements ILogoutHandler
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

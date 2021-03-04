<?php

namespace App\Features\Auth\Handlers;

use App\Features\Auth\Events\UserRegistered;
use App\Features\Auth\Requests\LoginRequest;
use App\Models\User;
use App\Services\Action\Action;
use App\Services\Action\ActionFactory;
use App\Services\Action\Results\ActionResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MeHandler extends Action
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

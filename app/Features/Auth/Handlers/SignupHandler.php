<?php

namespace App\Features\Auth\Handlers;

use App\Features\Auth\Events\UserRegistered;
use App\Features\Auth\Requests\LoginRequest;
use App\Features\Auth\Requests\SignupRequest;
use App\Models\User;
use App\Services\Action\Action;
use App\Services\Action\ActionFactory;
use App\Services\Action\Results\ActionResult;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupHandler extends Action
{

    public function __construct(SignupRequest $request)
    {
        parent::__construct($request);
    }


    public function handle(): ActionResult
    {
        $data = $this->input;
        $data['password'] = Hash::make($data['password']);

        if (User::where('email', $data['email'])->first()) {
            return ActionFactory::domainValidation(__('auth.email-already-registered'));
        }

        UserRegistered::dispatch(User::create($data));

        return ActionFactory::success(null, __("auth.user-created"));
    }
}

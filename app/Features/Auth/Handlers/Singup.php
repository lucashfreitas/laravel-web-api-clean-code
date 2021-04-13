<?php

namespace App\Features\Auth\Handlers;

use App\Features\Auth\Events\UserRegistered;
use App\Features\Auth\Requests\SignupRequest;
use App\Models\User;
use App\Core\Action\ActionFactory;
use App\Core\Action\Results\ActionResult;
use App\Core\Handler\RequestHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupHandler extends RequestHandler
{


    public function __construct(Request $request)
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

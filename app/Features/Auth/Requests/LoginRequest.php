<?php

namespace App\Features\Auth\Requests;

use App\Http\Requests\BaseRequest;
use App\Utils\StringUtils;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends BaseRequest
{

    public function messages()
    {
        return [
            'email.required' => __('auth.email-required'),
            'password.required' => __('auth.password-required'),
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6|max:255',
        ];
    }
}

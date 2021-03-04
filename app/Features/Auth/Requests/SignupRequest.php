<?php

namespace App\Features\Auth\Requests;

use App\Http\Requests\BaseRequest;

class SignupRequest extends BaseRequest
{
    public function messages()
    {
        return [
            'last_name.required' => 'An first name is required',
            'first_name.required' => 'An last name is required',
            'email.required' => 'An email is required',
            'password.required' => 'A password is required',
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
            'password' => 'required|min:6|max:50',
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
        ];
    }
}

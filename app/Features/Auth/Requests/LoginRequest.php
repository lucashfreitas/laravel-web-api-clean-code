<?php

namespace App\Features\Auth\Requests;


use Illuminate\Foundation\Http\FormRequest;


class LoginRequest extends FormRequest
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
            "email" => "required|email",
            "name" => "required|min:2",
            "password" => "required|min:6",
            "password_confirmation" => "same:password"
        ];
    }

    public function messages() {
        return [
            "email.required" => "Email field is required",
            "email.email" => "Invalid email format",
            "name.required" => "Name field is required",
            "name.min" => "At least 2 characters must be provided",
            "password.required" => "password field is required",
            "password.min" => "Password should be atleast 6 characters",
            "password_confirmation.same" => "Passwords doesn't match",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends UserRequest
{
    public function rules()
    {
        return [
            "name" => "min:2",
            "password" => "sometimes|nullable|min:6",
            "password_confirmation" => "same:password",
        ];
    }

    public function messages()
    {
        return [
            "name.min" => "At least 2 characters must be provided",
            "password.min" => "Password should be atleast 6 characters",
            "password_confirmation.same" => "Passwords doesn't match",
        ];
    }
}

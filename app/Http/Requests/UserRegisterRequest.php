<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email"    => "required|email|unique:users,email",
            "username" => "required|unique:users,username|min:6",
            "name"     => "required",
            "password" => "required|confirmed|min:8",
        ];
    }



    /**
     * @inheritdoc
     */
    public function fillableFields()
    {
        return [
            "name",
            "email",
            "username",
            "password",
            "password_confirmation",
        ];
    }


}

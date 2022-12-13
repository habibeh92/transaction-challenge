<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

    /**
     * @inheritdoc
     */
    public function fillableFields()
    {
        return [
            "email",
            "password",
        ];
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email"    => "required|email",
            "password" => "required",
        ];
    }
}

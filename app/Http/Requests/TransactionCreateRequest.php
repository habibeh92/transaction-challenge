<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'files'      => 'array',
            'files.*'    => "mimes:pdf|max:10240",
            'amount'     => 'required|numeric',
            'to_user_id' => 'required|exists:users,id',
        ];
    }
}

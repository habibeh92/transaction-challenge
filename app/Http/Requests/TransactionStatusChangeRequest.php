<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string status
 */
class TransactionStatusChangeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin()
        ;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "status" => [
                "required",
                Rule::in([
                    Transaction::STATUS_CONFIRMED,
                    Transaction::STATUS_REJECTED,
                ]),
            ],
        ];
    }
}

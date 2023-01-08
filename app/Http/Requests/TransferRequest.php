<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'transfer_from' => [
                'required',
                'exists:accounts,account_number',
            ],
            'transfer_to' => [
                'required',
                'numeric',
                'different:transfer_from',
                'exists:accounts,account_number'
            ],
            'name' => [
                'required',
                'exists:users,full_name'
            ],
            'transfer_amount' => [
                'required',
                'numeric',
                'min:0.01'
            ],
            'password' => [
                'required',
                'password'
            ],
            'code_input' => [
                'required',
                'exists:codes,code'
            ],
        ];
    }
}

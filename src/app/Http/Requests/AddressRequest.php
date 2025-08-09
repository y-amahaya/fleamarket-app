<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'postal_code' => 'required|max:8',
            'address' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.max'      => '郵便番号はハイフンありで8文字以内で入力してください。',

            'address.required'     => '住所を入力してください。',
            'address.max'          => '住所は100文字以内で入力してください。',
        ];
    }
}

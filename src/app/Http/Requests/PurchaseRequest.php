<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:convenience,card',
        ];
    }

    public function attributes(): array
    {
        return ['payment_method' => '支払い方法'];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => ':attributeを選択してください。',
            'payment_method.in'       => '有効な:attributeを選択してください。',
        ];
    }
}

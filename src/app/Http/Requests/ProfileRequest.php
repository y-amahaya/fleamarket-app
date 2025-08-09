<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'       => 'nullable|image|mimes:jpeg,png|max:2048',
            'name'        => 'required|string|max:20',
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image'        => '画像ファイルを選択してください。',
            'image.mimes'        => '画像はjpegまたはpng形式でアップロードしてください。',
            'image.max'          => '画像サイズは2MB以下にしてください。',
            'name.required'      => 'ユーザー名を入力してください。',
            'name.max'           => 'ユーザー名は20文字以内で入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.regex'  => '郵便番号はハイフンありの8文字で入力してください。',
            'address.required'   => '住所を入力してください。',
        ];
    }
}

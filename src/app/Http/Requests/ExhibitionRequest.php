<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'condition'   => 'required|string',
            'price'       => 'required|integer|min:0',

            'images'      => 'required|array|min:1',
            'images.*'    => 'required|image|mimes:jpeg,png,webp|max:5120',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => '商品名',
            'description' => '商品説明',
            'category_id' => '商品カテゴリー',
            'condition'   => '商品の状態',
            'price'       => '販売価格',
            'images'      => '商品画像',
            'images.*'    => '商品画像',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => ':attributeを入力してください。',
            'name.max'             => ':attributeは最大255文字です。',

            'description.required' => ':attributeを入力してください。',
            'description.max'      => ':attributeは最大255文字です。',

            'category_id.required' => ':attributeを選択してください。',
            'category_id.exists'   => '選択された:attributeが不正です。',

            'condition.required'   => ':attributeを選択してください。',

            'price.required'       => ':attributeを入力してください。',
            'price.integer'        => ':attributeは数値で入力してください。',
            'price.min'            => ':attributeは0円以上で入力してください。',

            'images.required'      => ':attributeを1枚以上アップロードしてください。',
            'images.array'         => ':attributeの形式が不正です。',
            'images.min'           => ':attributeを1枚以上アップロードしてください。',

            'images.*.required'    => ':attributeを選択してください。',
            'images.*.image'       => ':attributeは画像ファイルを選択してください。',
            'images.*.mimes'       => ':attributeはjpegまたはpng形式でアップロードしてください。',
            'images.*.uploaded'    => ':attributeのアップロードに失敗しました。（サイズ上限やタイムアウトの可能性があります）',
        ];
    }
}

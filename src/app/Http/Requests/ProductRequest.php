<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // すべてのリクエストを許可
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1|max:10000',
            'seasons' => 'required',
            'description' => 'required|string|max:120',
            'image' => 'required|image|mimes:png,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください。',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください。',
            'image.image' => 'アップロードされたファイルは画像形式ではありません。',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}


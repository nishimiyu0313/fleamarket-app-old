<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['required', 'max:255'],
            'image' => ['required', 'mimes:jpeg,jpg,png'],
            'price' =>['required','numeric','min:0'],
            'category_ids' => ['required'],
            'condition_id' => ['required']

        ];
    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '255文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '拡張子を.jpeg.jpgもしくは.pngで登録してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0円以上で入力してください',
            'category_ids.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください'


        ];
}
}

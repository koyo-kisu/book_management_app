<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'max:500',
            'tags' => 'json|regex:/^(?!.*\s).+$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'description' => '書籍の説明',
            'book_image' => '表示画像',
            'tags' => 'タグ',
        ];
    }

    // フォームリクエストのバリデーションが成功した後に自動的に呼ばれるメソッド
    public function passedValidation()
    {
        // 連想配列に変換、さらにコレクションに変換
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}

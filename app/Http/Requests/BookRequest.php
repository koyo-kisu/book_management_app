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
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'description' => '書籍の説明',
            'book_image' => '表示画像'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'start_on' => ['required', 'date_format:Y-m-d'],
            'end_on' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_on'],
        ];
    }

    public function attributes()
    {
        return [
            'start_on' => '貸出日',
            'end_on' => '返却日',
        ];
    }
}

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
            'booking_date_from' => ['required', 'date_format:Y-m-d'],
            'booking_date_to' => ['required', 'date_format:Y-m-d', 'after_or_equal:booking_date_from'],
        ];
    }

    public function attributes()
    {
        return [
            'booking_date_from' => '貸出日',
            'booking_date_to' => '返却日',
        ];
    }
}

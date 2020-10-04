<?php

namespace App\Http\Requests;

use App\Rules\CheckCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordModificationRequest extends FormRequest
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
            'current_password' => ['required', new CheckCurrentPassword($this->request->get('current_password'))],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}

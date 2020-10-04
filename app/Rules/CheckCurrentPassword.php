<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class CheckCurrentPassword implements Rule
{
    public $password;
    /**
     * Create a new rule instance.
     *
     * @param string $password
     * @return void
     */
    public function __construct(string $password)
    {
        $this->$password = $password;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \Hash::check($value, \Auth::user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '現在のパスワードが違います。';
    }
}

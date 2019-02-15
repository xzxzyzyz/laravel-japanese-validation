<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Alpha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha');
    }
}

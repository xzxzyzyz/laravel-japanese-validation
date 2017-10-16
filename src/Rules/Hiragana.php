<?php

namespace Xzxzyzyz\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hiragana implements Rule
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
        return preg_match("/^[ぁ-ん]+$/u", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = trans('validation.hiragana');

        if ($message == 'validation.hiragana') {
            $message = ':attributeはひらがなで入力してください。';
        }

        return $message;
    }
}

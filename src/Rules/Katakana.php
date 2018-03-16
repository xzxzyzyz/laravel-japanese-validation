<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Katakana implements Rule
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
        //  「半角カタカナ」を「全角カタカナ」に変換
        $text = mb_convert_kana($value, 'K', 'UTF-8');

        return preg_match("/^[ァ-ヶー]+$/u", $text);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = trans('validation.katakana');

        if ($message == 'validation.katakana') {
            $message = ':attributeはカタカナで入力してください。';
        }

        return $message;
    }
}

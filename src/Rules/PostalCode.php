<?php

namespace Xzxzyzyz\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class PostalCode implements Rule
{
    use FormatCharacterTrait;

    /**
     * 郵便番号ルール
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 全角数字を半角へ変換
        $text = mb_convert_kana($value, 'asK', 'UTF-8');

        // ハイフンを半角へ変換
        $text = $this->formatHyphen($text);

        return preg_match("/^\d{3}\-?\d{4}$/", $text);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = trans('validation.postal_code');

        if ($message == 'validation.postal_code') {
            $message = '郵便番号を確認してください。';
        }

        return $message;
    }
}

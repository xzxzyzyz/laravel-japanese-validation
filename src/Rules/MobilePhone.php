<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobilePhone implements Rule
{
    use FormatCharacterTrait;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 携帯電話番号バリデーション
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

        return preg_match("/^0[789]0-?[0-9]{4}-?[0-9]{4}$/", $text);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = trans('validation.mobile_phone');

        if ($message == 'validation.mobile_phone') {
            $message = '電話番号を確認してください。';
        }

        return $message;
    }
}

<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobilePhone implements ValidationRule
{
    use FormatCharacterTrait;

    /**
     * 携帯電話番号バリデーション
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 全角数字を半角へ変換
        $text = mb_convert_kana($value, 'asK', 'UTF-8');

        // ハイフンを半角へ変換
        $text = $this->formatHyphen($text);

        if (! preg_match("/^0[789]0-?[0-9]{4}-?[0-9]{4}$/", $text)) {
            $message = trans('validation.mobile_phone');

            if ($message == 'validation.mobile_phone') {
                $message = '電話番号を確認してください。';
            }

            $fail($message);
        }
    }
}

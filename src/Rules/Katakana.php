<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Katakana implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //  「半角カタカナ」を「全角カタカナ」に変換
        $text = mb_convert_kana($value, 'K', 'UTF-8');

        if (! preg_match('/^[ァ-ヶー]+$/u', $text)) {
            $message = trans('validation.katakana');

            if ($message == 'validation.katakana') {
                $message = ':attributeはカタカナで入力してください。';
            }

            $fail($message);
        }
    }
}

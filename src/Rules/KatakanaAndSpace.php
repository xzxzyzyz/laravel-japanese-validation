<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KatakanaAndSpace implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^[ 　]+$/u', $value)) {
            $fail($this->message());
            return;
        }

        //  「半角カタカナ」を「全角カタカナ」に変換
        $text = mb_convert_kana($value, 'K', 'UTF-8');

        if (! preg_match('/^[ァ-ヶー 　]+$/u', $text)) {
            $fail($this->message());
        }
    }

    private function message(): string
    {
        $message = trans('validation.katakana');

        if ($message == 'validation.katakana') {
            $message = ':attributeはカタカナで入力してください。';
        }

        return $message;
    }
}

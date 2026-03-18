<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostalCode implements ValidationRule
{
    use FormatCharacterTrait;

    /**
     * 郵便番号ルール
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 全角数字を半角へ変換
        $text = mb_convert_kana($value, 'asK', 'UTF-8');

        // ハイフンを半角へ変換
        $text = $this->formatHyphen($text);

        if (! preg_match("/^\d{3}\-?\d{4}$/", $text)) {
            $message = trans('validation.postal_code');

            if ($message == 'validation.postal_code') {
                $message = '郵便番号を確認してください。';
            }

            $fail($message);
        }
    }
}

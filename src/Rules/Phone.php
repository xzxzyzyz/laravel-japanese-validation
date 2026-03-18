<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    use FormatCharacterTrait;

    /**
     * 電話番号バリデーション
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 全角数字を半角へ変換
        $text = mb_convert_kana($value, 'asK', 'UTF-8');

        // ハイフンを半角へ変換
        $text = $this->formatHyphen($text);

        if (! preg_match("/^[\d]{2,4}-?[\d]{2,4}-?[\d]{3,4}$/", $text)) {
            $fail($this->message());
        }
    }

    protected function message(): string
    {
        $message = trans('validation.phone');

        if ($message == 'validation.phone') {
            $message = '電話番号を確認してください。';
        }

        return $message;
    }
}

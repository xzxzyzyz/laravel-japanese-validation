<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HiraganaAndSpace implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^[ 　]+$/u', $value)) {
            $fail($this->message());
            return;
        }

        if (! preg_match('/^[ぁ-んー 　]+$/u', $value)) {
            $fail($this->message());
        }
    }

    private function message(): string
    {
        $message = trans('validation.hiragana');

        if ($message == 'validation.hiragana') {
            $message = ':attributeはひらがなで入力してください。';
        }

        return $message;
    }
}

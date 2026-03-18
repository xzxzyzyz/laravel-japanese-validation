<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Hiragana implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[ぁ-んー]+$/u', $value)) {
            $message = trans('validation.hiragana');

            if ($message == 'validation.hiragana') {
                $message = ':attributeはひらがなで入力してください。';
            }

            $fail($message);
        }
    }
}

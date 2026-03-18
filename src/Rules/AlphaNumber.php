<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[A-Za-z\d]+$/', $value)) {
            $fail(trans('validation.alpha_num'));
        }
    }
}

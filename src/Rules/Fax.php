<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Fax extends Phone implements Rule
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = trans('validation.fax');

        if ($message == 'validation.fax') {
            $message = 'FAX番号を確認してください。';
        }

        return $message;
    }
}

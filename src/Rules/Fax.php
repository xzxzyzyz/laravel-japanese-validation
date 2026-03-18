<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

class Fax extends Phone
{
    protected function message(): string
    {
        $message = trans('validation.fax');

        if ($message == 'validation.fax') {
            $message = 'FAX番号を確認してください。';
        }

        return $message;
    }
}

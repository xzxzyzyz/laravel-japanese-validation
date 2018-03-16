<?php

namespace Xzxzyzyz\Laravel\JapaneseValidation\Rules;

trait FormatCharacterTrait
{
    public function formatHyphen($value)
    {
        $table = [
            'ー' => '-',
            '−' => '-',
        ];

        // ハイフンを半角へ変換
        $search = array_keys($table);
        $replace = array_values($table);

        return str_replace($search, $replace, $value);
    }
}

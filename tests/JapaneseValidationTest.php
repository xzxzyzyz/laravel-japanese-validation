<?php

use Xzxzyzyz\Laravel\JapaneseValidation\Rules;

function passes(object $rule, string $value): bool
{
    $failed = false;

    try {
        $rule->validate('dummy', $value, function () use (&$failed) {
            $failed = true;
        });
    } catch (\Throwable) {
        $failed = true;
    }

    return ! $failed;
}

test('hiragana', function () {
    $rule = new Rules\Hiragana;
    expect(passes($rule, 'あいうえお'))->toBeTrue();
    expect(passes($rule, 'あいうえおー'))->toBeTrue();
    expect(passes($rule, 'あいう えお'))->toBeFalse();
    expect(passes($rule, 'アイウエオ'))->toBeFalse();
});

test('hiragana and space', function () {
    $rule = new Rules\HiraganaAndSpace();
    expect(passes($rule, 'あいう えお'))->toBeTrue();
    expect(passes($rule, 'あいう えおー'))->toBeTrue();
    expect(passes($rule, 'あいう　えお'))->toBeTrue();
    expect(passes($rule, ' 　'))->toBeFalse();
});

test('katakana', function () {
    $rule = new Rules\Katakana;
    expect(passes($rule, 'アイウエオ'))->toBeTrue();
    expect(passes($rule, 'アイウエオー'))->toBeTrue();
    expect(passes($rule, 'ｱｲｳｴｵ'))->toBeTrue();
    expect(passes($rule, 'アイ ウエオ'))->toBeFalse();
    expect(passes($rule, 'あいうえお'))->toBeFalse();
});

test('katakana and space', function () {
    $rule = new Rules\KatakanaAndSpace;
    expect(passes($rule, 'アイウ エオ'))->toBeTrue();
    expect(passes($rule, 'アイウ エオー'))->toBeTrue();
    expect(passes($rule, 'ｱｲｳ　ｴｵ'))->toBeTrue();
    expect(passes($rule, ' 　'))->toBeFalse();
});

test('phone', function () {
    $rule = new Rules\Phone;
    expect(passes($rule, '00011112222'))->toBeTrue();
    expect(passes($rule, '000-1111-2222'))->toBeTrue();
    expect(passes($rule, '０００１１１１２２２２'))->toBeTrue();
    expect(passes($rule, '０００ー１１１１ー２２２２'))->toBeTrue();
});

test('fax', function () {
    $rule = new Rules\Fax();
    expect(passes($rule, '00011112222'))->toBeTrue();
    expect(passes($rule, '000-1111-2222'))->toBeTrue();
    expect(passes($rule, '０００１１１１２２２２'))->toBeTrue();
    expect(passes($rule, '０００ー１１１１ー２２２２'))->toBeTrue();
});

test('postal code', function () {
    $rule = new Rules\PostalCode;
    expect(passes($rule, '1234567'))->toBeTrue();
    expect(passes($rule, '123-4567'))->toBeTrue();
    expect(passes($rule, '１２３４５６７'))->toBeTrue();
    expect(passes($rule, '１２３ー４５６７'))->toBeTrue();
});

test('pref', function () {
    $rule = new Rules\Pref;
    expect(passes($rule, '北海道'))->toBeTrue();
    expect(passes($rule, 'Hokkaido'))->toBeFalse();
});

test('alpha', function () {
    $rule = new Rules\Alpha;
    expect(passes($rule, 'abc'))->toBeTrue();
    expect(passes($rule, 'ABC'))->toBeTrue();
    expect(passes($rule, 'ａｂｃ'))->toBeFalse();
    expect(passes($rule, 'ＡＢＣ'))->toBeFalse();
});

test('alpha dash', function () {
    $rule = new Rules\AlphaDash;
    expect(passes($rule, 'abc'))->toBeTrue();
    expect(passes($rule, 'ABC'))->toBeTrue();
    expect(passes($rule, '-'))->toBeTrue();
    expect(passes($rule, '_'))->toBeTrue();
    expect(passes($rule, 'ａｂｃ'))->toBeFalse();
    expect(passes($rule, 'ＡＢＣ'))->toBeFalse();
    expect(passes($rule, 'ー'))->toBeFalse();
    expect(passes($rule, '−'))->toBeFalse();
});

test('alpha number', function () {
    $rule = new Rules\AlphaNumber;
    expect(passes($rule, 'abc'))->toBeTrue();
    expect(passes($rule, 'ABC'))->toBeTrue();
    expect(passes($rule, '123'))->toBeTrue();
    expect(passes($rule, 'ａｂｃ'))->toBeFalse();
    expect(passes($rule, 'ＡＢＣ'))->toBeFalse();
    expect(passes($rule, '１２３'))->toBeFalse();
});

test('mobile phone', function () {
    $rule = new Rules\MobilePhone;
    expect(passes($rule, '09011112222'))->toBeTrue();
    expect(passes($rule, '080-1111-2222'))->toBeTrue();
    expect(passes($rule, '０７０１１１１２２２２'))->toBeTrue();
    expect(passes($rule, '０７０ー１１１１ー２２２２'))->toBeTrue();
});

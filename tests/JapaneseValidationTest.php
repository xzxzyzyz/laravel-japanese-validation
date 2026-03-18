<?php

use Xzxzyzyz\Laravel\JapaneseValidation\Rules;
use PHPUnit\Framework\TestCase as BaseTestCase;

if (! function_exists('trans')) {
    function trans(string $key): string
    {
        return $key;
    }
}

class JapaneseValidationTest extends BaseTestCase
{
    private function passes(object $rule, string $value): bool
    {
        $failed = false;
        $rule->validate('dummy', $value, function () use (&$failed) {
            $failed = true;
        });

        return ! $failed;
    }

    public function testHiragana()
    {
        $rule = new Rules\Hiragana;
        $this->assertTrue($this->passes($rule, 'あいうえお'));
        $this->assertTrue($this->passes($rule, 'あいうえおー'));
        $this->assertFalse($this->passes($rule, 'あいう えお'));
        $this->assertFalse($this->passes($rule, 'アイウエオ'));
    }

    public function testHiraganaAndSpace()
    {
        $rule = new Rules\HiraganaAndSpace();
        $this->assertTrue($this->passes($rule, 'あいう えお'));
        $this->assertTrue($this->passes($rule, 'あいう えおー'));
        $this->assertTrue($this->passes($rule, 'あいう　えお'));
        $this->assertFalse($this->passes($rule, ' 　'));
    }

    public function testKatakana()
    {
        $rule = new Rules\Katakana;
        $this->assertTrue($this->passes($rule, 'アイウエオ'));
        $this->assertTrue($this->passes($rule, 'アイウエオー'));
        $this->assertTrue($this->passes($rule, 'ｱｲｳｴｵ'));
        $this->assertFalse($this->passes($rule, 'アイ ウエオ'));
        $this->assertFalse($this->passes($rule, 'あいうえお'));
    }

    public function testKatakanaAndSpace()
    {
        $rule = new Rules\KatakanaAndSpace;
        $this->assertTrue($this->passes($rule, 'アイウ エオ'));
        $this->assertTrue($this->passes($rule, 'アイウ エオー'));
        $this->assertTrue($this->passes($rule, 'ｱｲｳ　ｴｵ'));
        $this->assertFalse($this->passes($rule, ' 　'));
    }

    public function testPhone()
    {
        $rule = new Rules\Phone;
        $this->assertTrue($this->passes($rule, '00011112222'));
        $this->assertTrue($this->passes($rule, '000-1111-2222'));
        $this->assertTrue($this->passes($rule, '０００１１１１２２２２'));
        $this->assertTrue($this->passes($rule, '０００ー１１１１ー２２２２'));
    }

    public function testFax()
    {
        $rule = new Rules\Fax();
        $this->assertTrue($this->passes($rule, '00011112222'));
        $this->assertTrue($this->passes($rule, '000-1111-2222'));
        $this->assertTrue($this->passes($rule, '０００１１１１２２２２'));
        $this->assertTrue($this->passes($rule, '０００ー１１１１ー２２２２'));
    }

    public function testPostalCode()
    {
        $rule = new Rules\PostalCode;
        $this->assertTrue($this->passes($rule, '1234567'));
        $this->assertTrue($this->passes($rule, '123-4567'));
        $this->assertTrue($this->passes($rule, '１２３４５６７'));
        $this->assertTrue($this->passes($rule, '１２３ー４５６７'));
    }

    public function testPref()
    {
        $rule = new Rules\Pref;
        $this->assertTrue($this->passes($rule, '北海道'));
        $this->assertFalse($this->passes($rule, 'Hokkaido'));
    }

    public function testAlpha()
    {
        $rule = new Rules\Alpha;
        $this->assertTrue($this->passes($rule, 'abc'));
        $this->assertTrue($this->passes($rule, 'ABC'));
        $this->assertFalse($this->passes($rule, 'ａｂｃ'));
        $this->assertFalse($this->passes($rule, 'ＡＢＣ'));
    }

    public function testAlphaDash()
    {
        $rule = new Rules\AlphaDash;
        $this->assertTrue($this->passes($rule, 'abc'));
        $this->assertTrue($this->passes($rule, 'ABC'));
        $this->assertTrue($this->passes($rule, '-'));
        $this->assertTrue($this->passes($rule, '_'));
        $this->assertFalse($this->passes($rule, 'ａｂｃ'));
        $this->assertFalse($this->passes($rule, 'ＡＢＣ'));
        $this->assertFalse($this->passes($rule, 'ー'));
        $this->assertFalse($this->passes($rule, '−'));
    }

    public function testAlphaNumber()
    {
        $rule = new Rules\AlphaNumber;
        $this->assertTrue($this->passes($rule, 'abc'));
        $this->assertTrue($this->passes($rule, 'ABC'));
        $this->assertTrue($this->passes($rule, '123'));
        $this->assertFalse($this->passes($rule, 'ａｂｃ'));
        $this->assertFalse($this->passes($rule, 'ＡＢＣ'));
        $this->assertFalse($this->passes($rule, '１２３'));
    }

    public function testMobilePhone()
    {
        $rule = new Rules\MobilePhone;
        $this->assertTrue($this->passes($rule, '09011112222'));
        $this->assertTrue($this->passes($rule, '080-1111-2222'));
        $this->assertTrue($this->passes($rule, '０７０１１１１２２２２'));
        $this->assertTrue($this->passes($rule, '０７０ー１１１１ー２２２２'));
    }
}

<?php

use Xzxzyzyz\Laravel\JapaneseValidation\Rules;
use PHPUnit\Framework\TestCase as BaseTestCase;

class JapaneseValidationTest extends BaseTestCase
{
    public function testHiragana()
    {
        $rule = new Rules\Hiragana;
        $this->assertEquals(true, $rule->passes('dummy', 'あいうえお'));
        $this->assertEquals(false, $rule->passes('dummy', 'あいう えお'));
        $this->assertEquals(false, $rule->passes('dummy', 'アイウエオ'));
    }

    public function testHiraganaAndSpace()
    {
        $rule = new Rules\HiraganaAndSpace();
        $this->assertEquals(true, $rule->passes('dummy', 'あいう えお'));
        $this->assertEquals(true, $rule->passes('dummy', 'あいう　えお'));
        $this->assertEquals(false, $rule->passes('dummy', ' 　'));
    }

    public function testKatakana()
    {
        $rule = new Rules\Katakana;
        $this->assertEquals(true, $rule->passes('dummy', 'アイウエオ'));
        $this->assertEquals(true, $rule->passes('dummy', 'ｱｲｳｴｵ'));
        $this->assertEquals(false, $rule->passes('dummy', 'アイ ウエオ'));
        $this->assertEquals(false, $rule->passes('dummy', 'あいうえお'));
    }

    public function testKatakanaAndSpace()
    {
        $rule = new Rules\KatakanaAndSpace;
        $this->assertEquals(true, $rule->passes('dummy', 'アイウ エオ'));
        $this->assertEquals(true, $rule->passes('dummy', 'ｱｲｳ　ｴｵ'));
        $this->assertEquals(false, $rule->passes('dummy', ' 　'));
    }

    public function testPhone()
    {
        $rule = new Rules\Phone;
        $this->assertEquals(true, $rule->passes('dummy', '00011112222'));
        $this->assertEquals(true, $rule->passes('dummy', '000-1111-2222'));
        $this->assertEquals(true, $rule->passes('dummy', '０００１１１１２２２２'));
        $this->assertEquals(true, $rule->passes('dummy', '０００ー１１１１ー２２２２'));
    }

    public function testPostalCode()
    {
        $rule = new Rules\PostalCode;
        $this->assertEquals(true, $rule->passes('dummy', '1234567'));
        $this->assertEquals(true, $rule->passes('dummy', '123-4567'));
        $this->assertEquals(true, $rule->passes('dummy', '１２３４５６７'));
        $this->assertEquals(true, $rule->passes('dummy', '１２３ー４５６７'));
    }

    public function testPref()
    {
        $rule = new Rules\Pref;
        $this->assertEquals(true, $rule->passes('dummy', '北海道'));
        $this->assertEquals(false, $rule->passes('dummy', 'Hokkaido'));
    }
}

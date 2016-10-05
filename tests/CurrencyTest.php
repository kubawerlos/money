<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use PHPUnit\Framework\TestCase;

/**
 * @covers KubaWerlos\Money\Currency
 */
class CurrencyTest extends TestCase
{
    public function testCreatingInvalidCurrency()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('ABC');
    }

    public function testGettingCode()
    {
        $currency = new Currency('USD');
        $this->assertSame('USD', $currency->getCode());
    }

    public function testGettingFractionDigits()
    {
        $currency = new Currency('EUR');
        $this->assertSame(2, $currency->getFractionDigits());
    }

    public function testEqualityToItself()
    {
        $currency = new Currency('JPY');
        $this->assertTrue($currency->isEqual($currency));
    }

    public function testEqualityForTheSameCodes()
    {
        $currency1 = new Currency('GBP');
        $currency2 = new Currency('GBP');
        $this->assertTrue($currency1->isEqual($currency2));
    }

    public function testInequalityForTheDifferentCodes()
    {
        $currency1 = new Currency('AUD');
        $currency2 = new Currency('CAD');
        $this->assertFalse($currency1->isEqual($currency2));
    }

    public function testGettingUnitAmountForSubunitAmount()
    {
        $currency = new Currency('CHF');
        $this->assertSame('19.50', $currency->getUnitAmountForSubunitAmount(1950));
    }

    public function testGettingSubunitAmountForUnitAmountBeingBoolean()
    {
        $currency = new Currency('CNY');
        $this->expectException(\InvalidArgumentException::class);
        $currency->getSubunitAmountForUnitAmount(true);
    }

    public function testGettingSubunitAmountForUnitAmountBeingFloat()
    {
        $currency = new Currency('SEK');
        $this->assertSame(150, $currency->getSubunitAmountForUnitAmount(1.5));
    }

    public function testGettingSubunitAmountForUnitAmountBeingInteger()
    {
        $currency = new Currency('MXN');
        $this->assertSame(400, $currency->getSubunitAmountForUnitAmount(4));
    }

    public function testGettingSubunitAmountForUnitAmountBeingString()
    {
        $currency = new Currency('NZD');
        $this->assertSame(1200, $currency->getSubunitAmountForUnitAmount('12.00'));
    }

    public function testGettingSubunitAmountForUnitAmountBeingOutOfRange()
    {
        $currency = new Currency('CNY');
        $this->expectException(\RangeException::class);
        $currency->getSubunitAmountForUnitAmount(PHP_INT_MAX);
    }

    public function testGettingSubunitAmountForUnitAmountBeingInvalidString()
    {
        $currency = new Currency('SGD');
        $this->expectException(\InvalidArgumentException::class);
        $currency->getSubunitAmountForUnitAmount('12.345');
    }

    /**
     * @dataProvider getFractionDigitsProvider
     */
    public function testFractionDigitsForIsoStandard(string $code, int $fractionDigits)
    {
        $currency = new Currency($code);

        $this->assertSame($fractionDigits, $currency->getFractionDigits());
    }

    public function getFractionDigitsProvider() : array
    {
        $xml = simplexml_load_file('http://www.currency-iso.org/dam/downloads/lists/list_one.xml');

        $currencies = [];

        foreach ($xml->CcyTbl->children() as $child) {
            if (!empty($child->Ccy)) {
                $currencies[] = [strval($child->Ccy), intval($child->CcyMnrUnts)];
            }
        }

        return $currencies;
    }
}

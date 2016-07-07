<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Money::isEqual
 */
class IsEqualTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider equalMoneyProvider
     * @param int|float|string $amount1
     * @param int|float|string $amount2
     * @param string $currencyCode
     * @test
     */
    public function equalMoney($amount1, $amount2, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $money1 = new Money($amount1, $currency);
        $money2 = new Money($amount2, $currency);

        $this->assertTrue($money1->isEqual($money1));
        $this->assertTrue($money1->isEqual($money2));
        $this->assertTrue($money2->isEqual($money1));
    }

    /**
     * @return array
     */
    public function equalMoneyProvider()
    {
        return [
            [ 0, 0, 'USD' ],
            [ 1000, 1000, 'EUR' ],
            [ 2.5, 2.5, 'PLN' ],
            [ -4, -4, 'TRY' ],
            [ -1.75, -1.75, 'AUD' ],
        ];
    }

    /**
     * @dataProvider notEqualMoneyProvider
     * @param int|float|string $amount1
     * @param int|float|string $amount2
     * @param string $currencyCode1
     * @param string $currencyCode2
     * @test
     */
    public function notEqualMoney($amount1, $amount2, $currencyCode1, $currencyCode2)
    {
        $currency1 = new Currency($currencyCode1);
        $currency2 = new Currency($currencyCode2);
        $money1 = new Money($amount1, $currency1);
        $money2 = new Money($amount2, $currency2);

        $this->assertFalse($money1->isEqual($money2));
        $this->assertFalse($money2->isEqual($money1));
    }

    /**
     * @return array
     */
    public function notEqualMoneyProvider()
    {
        return [
            [ 0, 1, 'USD', 'USD' ],
            [ 2, -2, 'EUR', 'EUR' ],
            [ 1000.01, 1000.02, 'EUR', 'EUR' ],
            [ 1000, 1000, 'EUR', 'PLN' ],
            [ -5, -5, 'TRY', 'JPY' ],
        ];
    }
}

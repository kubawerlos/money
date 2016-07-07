<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Money::isInTheSameCurrency
 */
class IsInTheSameCurrencyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sameCurrencyProvider
     * @param int|float|string $amount1
     * @param int|float|string $amount2
     * @param string $currencyCode
     * @test
     */
    public function sameCurrency($amount1, $amount2, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $money1 = new Money($amount1, $currency);
        $money2 = new Money($amount2, $currency);

        $this->assertTrue($money1->isInTheSameCurrency($money1));
        $this->assertTrue($money1->isInTheSameCurrency($money2));
        $this->assertTrue($money2->isInTheSameCurrency($money1));
    }

    /**
     * @return array
     */
    public function sameCurrencyProvider()
    {
        return [
            [ 10, 50, 'USD' ],
            [ 5.5, 200, 'EUR' ],
            [ 6, -800, 'JPY' ],
        ];
    }

    /**
     * @dataProvider notSameCurrencyProvider
     * @param int|float|string $amount1
     * @param int|float|string $amount2
     * @param string $currencyCode1
     * @param string $currencyCode2
     * @test
     */
    public function notSameCurrency($amount1, $amount2, $currencyCode1, $currencyCode2)
    {
        $currency1 = new Currency($currencyCode1);
        $currency2 = new Currency($currencyCode2);
        $money1 = new Money($amount1, $currency1);
        $money2 = new Money($amount2, $currency2);

        $this->assertFalse($money1->isInTheSameCurrency($money2));
        $this->assertFalse($money2->isInTheSameCurrency($money1));
    }

    /**
     * @return array
     */
    public function notSameCurrencyProvider()
    {
        return [
            [ 10, 10, 'USD', 'EUR' ],
            [ 100, 100, 'USD', 'EUR' ],
            [ 55, -3, 'JPY', 'TRY' ],
        ];
    }
}

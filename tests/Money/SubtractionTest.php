<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::subtract
 * @covers \KubaWerlos\Money\Money::<private>
 */
class SubtractionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctSubtractionProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param string $addedAmount
     * @param string $currencyCode
     * @test
     */
    public function correctSubtraction($expectedAmount, $baseAmount, $addedAmount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);
        $addedMoney = new Money($addedAmount, $currency);

        $actualMoney = $baseMoney->subtract($addedMoney);

        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function correctSubtractionProvider()
    {
        return [
            [ 2, 4, 2, 'USD' ],
            [ 0, 5.55, 5.55, 'EUR' ],
            [ 1.11, 3.33, 2.22, 'PLN' ],
            [ -0.01, 999999.99, 1000000, 'TRY' ],
        ];
    }

    /**
     * @dataProvider incorrectSubtractionProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param string $addedAmount
     * @param string $currencyCode
     * @test
     */
    public function incorrectSubtraction($expectedAmount, $baseAmount, $addedAmount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);
        $addedMoney = new Money($addedAmount, $currency);

        $actualMoney = $baseMoney->subtract($addedMoney);

        $this->assertFalse($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function incorrectSubtractionProvider()
    {
        return [
            [ 2, 5, 2, 'USD' ],
            [ 1.50, 3.50, 2.50, 'EUR' ],
            [ 0, 1000000, 999999.99, 'PLN' ],
            [ -2, 999999, 1000000, 'HUF' ],
        ];
    }

    /**
     * @test
     */
    public function throwInvalidArgumentExceptionForNotMatchingCurrencies()
    {
        $moneyEuro = new Money(10, new Currency('EUR'));
        $moneyDollars = new Money(10, new Currency('USD'));

        $this->expectException(\InvalidArgumentException::class);

        $moneyEuro->subtract($moneyDollars);
    }

    /**
     * @test
     */
    public function throwsRangeExceptionWhenResultIsTooSmall()
    {
        $moneySmall = new Money((int) (100 - PHP_INT_MAX / 100), new Currency('USD'));
        $moneyLarge = new Money((int) (PHP_INT_MAX / 100 - 100), new Currency('USD'));

        $this->expectException(\RangeException::class);

        $moneySmall->subtract($moneyLarge);
    }
}
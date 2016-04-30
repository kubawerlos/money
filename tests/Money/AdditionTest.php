<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::add
 * @covers \KubaWerlos\Money\Money::<private>
 */
class AdditionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctAdditionProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param string $addedAmount
     * @param string $currencyCode
     * @test
     */
    public function correctAddition($expectedAmount, $baseAmount, $addedAmount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);
        $addedMoney = new Money($addedAmount, $currency);

        $actualMoney = $baseMoney->add($addedMoney);

        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function correctAdditionProvider()
    {
        return [
            [ 4, 2, 2, 'USD' ],
            [ 36.49, 25.50, 10.99, 'EUR' ],
            [ 26.60, 16.40, 10.20, 'PLN' ],
            [ 38.30, 46.40, -8.10, 'TRY' ],
            [ 0, -8.00, 8, 'AUD' ],
            [ 4, 6, -2, 'HUF' ],
        ];
    }

    /**
     * @dataProvider incorrectAdditionProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param string $addedAmount
     * @param string $currencyCode
     * @test
     */
    public function incorrectAddition($expectedAmount, $baseAmount, $addedAmount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);
        $addedMoney = new Money($addedAmount, $currency);

        $actualMoney = $baseMoney->add($addedMoney);

        $this->assertFalse($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function incorrectAdditionProvider()
    {
        return [
            [ 5, 2, 2, 'USD' ],
            [ 3.50, 1.50, 2.50, 'USD' ],
            [ 0, 1.50, -1.49, 'USD' ],
            [ 0, 16.40, -16.39, 'USD' ],
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

        $moneyEuro->add($moneyDollars);
    }

    /**
     * @test
     */
    public function throwRangeExceptionWhenResultIsTooLarge()
    {
        $money = new Money((int) (PHP_INT_MAX / 100 - 100), new Currency('USD'));

        $this->expectException(\RangeException::class);

        $money->add($money);
    }
}
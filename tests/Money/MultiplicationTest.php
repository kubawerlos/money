<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;
use RangeException;

/**
 * @covers KubaWerlos\Money\Money::multiply
 * @covers KubaWerlos\Money\Money::<private>
 */
class MultiplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctMultiplicationProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param int|float $multiplier
     * @param string $currencyCode
     * @test
     */
    public function correctMultiplication($expectedAmount, $baseAmount, $multiplier, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);

        $actualMoney = $baseMoney->multiply($multiplier);

        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function correctMultiplicationProvider()
    {
        return array(
            array( 4, 2, 2, 'USD' ),
            array( 0, 612.33, 0, 'USD' ),
            array( 77.77, 11.11, 7, 'EUR' ),
            array( 123, 100, 1.23, 'PLN' ),
            array( -160, 80, -2, 'TRY' ),
            array( 12.34, 123.4, 0.1, 'AUD' ),
            array( -18, -6, 3, 'ITL' ),
            array( 30, -5, -6, 'ITL' ),
        );
    }

    /**
     * @dataProvider incorrectMultiplicationProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param mixed $multiplier
     * @param string $currencyCode
     * @test
     */
    public function incorrectMultiplication($expectedAmount, $baseAmount, $multiplier, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);

        $actualMoney = $baseMoney->multiply($multiplier);

        $this->assertFalse($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function incorrectMultiplicationProvider()
    {
        return array(
            array( 5, 2, 2, 'USD' ),
            array( 2.50, 1.50, 2, 'USD' ),
        );
    }

    /**
     * @test
     */
    public function throwRangeExceptionWhenResultIsTooLarge()
    {
        $money = new Money((int) (PHP_INT_MAX / 100 - 100), new Currency('USD'));

        $this->expectException(RangeException::class);

        $money->multiply(1000);
    }

    /**
     * @test
     */
    public function throwRangeExceptionWhenResultIsTooSmall()
    {
        $money = new Money((int) (100 - PHP_INT_MAX / 100), new Currency('USD'));

        $this->expectException(RangeException::class);

        $money->multiply(1000);
    }
}

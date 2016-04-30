<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::divide
 * @covers \KubaWerlos\Money\Money::<private>
 */
class DivisionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctMultiplicationProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param int|float $divisor
     * @param string $currencyCode
     * @test
     */
    public function correctMultiplication($expectedAmount, $baseAmount, $divisor, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);

        $actualMoney = $baseMoney->divide($divisor);

        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function correctMultiplicationProvider()
    {
        return array(
            array( 0, 0, 8, 'USD' ),
            array( 4.1, 12.3, 3, 'USD' ),
            array( 12.34, 123.4, 10, 'USD' ),
            array( 11.11, 77.77, 7, 'USD' ),
            array( 77.77, 11.11, 1/7, 'EUR' ),
            array( 1.23, 123, 100, 'PLN' ),
            array( -160, 80, -0.5, 'TRY' ),
            array( 8000.01, 16000.02, 2, 'AUD' ),
            array( 321.42, 642.84, 2, 'AUD' ),
            array( 0.01, 0.03, 3, 'AUD' ),
            array( 2, -8, -4, 'HUF' ),
            array( 3, 5, 2, 'HUF' ),
        );
    }

    /**
     * @dataProvider incorrectMultiplicationProvider
     * @param string $expectedAmount
     * @param string $baseAmount
     * @param mixed $divisor
     * @param string $currencyCode
     * @test
     */
    public function incorrectMultiplication($expectedAmount, $baseAmount, $divisor, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $expectedMoney = new Money($expectedAmount, $currency);
        $baseMoney = new Money($baseAmount, $currency);

        $actualMoney = $baseMoney->divide($divisor);

        $this->assertFalse($expectedMoney->isEqual($actualMoney));
    }

    /**
     * @return array
     */
    public function incorrectMultiplicationProvider()
    {
        return array(
            array( 2, 5, 2, 'USD' ),
            array( 1.24, 2.50, 2, 'USD' ),
        );
    }

    /**
     * @test
     */
    public function throwRangeExceptionWhenDividingByZero()
    {
        $money = new Money(10, new Currency('USD'));

        $this->setExpectedException(\RangeException::class);

        $money->divide(0);
    }
}

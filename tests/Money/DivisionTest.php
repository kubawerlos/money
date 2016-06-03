<?php

namespace Tests\Money;

use InvalidArgumentException;
use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Money::divide
 * @covers KubaWerlos\Money\Money::<private>
 */
class DivisionTest extends PHPUnit_Framework_TestCase
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
        return [
            [ 0, 0, 8, 'USD' ],
            [ 4.1, 12.3, 3, 'USD' ],
            [ 12.34, 123.4, 10, 'USD' ],
            [ 11.11, 77.77, 7, 'USD' ],
            [ 77.77, 11.11, 1/7, 'EUR' ],
            [ 1.23, 123, 100, 'PLN' ],
            [ -160, 80, -0.5, 'TRY' ],
            [ 8000.01, 16000.02, 2, 'AUD' ],
            [ 321.42, 642.84, 2, 'AUD' ],
            [ 0.01, 0.03, 3, 'AUD' ],
            [ 2, -8, -4, 'ITL' ],
            [ 3, 5, 2, 'ITL' ],
        ];
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
        return [
            [ 2, 5, 2, 'USD' ],
            [ 1.24, 2.50, 2, 'USD' ],
        ];
    }

    /**
     * @test
     */
    public function throwInvalidArgumentExceptionWhenDividingByZero()
    {
        $money = new Money(10, new Currency('USD'));

        $this->expectException(InvalidArgumentException::class);

        $money->divide(0);
    }
}

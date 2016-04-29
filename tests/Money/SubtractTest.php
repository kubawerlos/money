<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::subtract
 * @covers \KubaWerlos\Money\Money::calculate
 */
class SubtractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctSubtractionProvider
     * @param Money $base
     * @param Money $subtracted
     * @param Money $expected
     * @test
     */
    public function correctSubtraction(Money $base, Money $subtracted, Money $expected)
    {
        $this->assertTrue($expected->isEqual($base->subtract($subtracted)));
    }

    /**
     * @return array
     */
    public function correctSubtractionProvider()
    {
        return [
            [
                new Money(4, new Currency('USD')),
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('USD')),
            ],
            [
                new Money(5.55, new Currency('USD')),
                new Money(5.55, new Currency('USD')),
                new Money(0, new Currency('USD')),
            ],
            [
                new Money(3.33, new Currency('USD')),
                new Money(2.22, new Currency('USD')),
                new Money(1.11, new Currency('USD')),
            ],
        ];
    }

    /**
     * @dataProvider incorrectSubtractionProvider
     * @param Money $base
     * @param Money $subtracted
     * @param Money $expected
     * @test
     */
    public function incorrectSubtraction(Money $base, Money $subtracted, Money $expected)
    {
        $this->assertFalse($expected->isEqual($base->subtract($subtracted)));
    }

    /**
     * @return array
     */
    public function incorrectSubtractionProvider()
    {
        return [
            [
                new Money(5, new Currency('USD')),
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('USD')),
            ],
            [
                new Money(3.50, new Currency('USD')),
                new Money(2.50, new Currency('USD')),
                new Money(1.50, new Currency('USD')),
            ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotMatchingCurrenciesProvider
     * @param Money $base
     * @param Money $subtracted
     * @test
     */
    public function throwInvalidArgumentExceptionForNotMatchingCurrencies(Money $base, Money $subtracted)
    {
        $this->expectException(\InvalidArgumentException::class);

        $base->subtract($subtracted);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotMatchingCurrenciesProvider()
    {
        return [
            [
                new Money(2, new Currency('EUR')),
                new Money(2, new Currency('USD')),
            ],
            [
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('EUR')),
            ],
        ];
    }

    /**
     * @test
     */
    public function throwsRangeExceptionWhenResultIsTooSmall()
    {
        $money = new Money((int) (100 - PHP_INT_MAX / 100), new Currency('USD'));

        $this->expectException(\RangeException::class);

        $money->subtract(new Money((int) (PHP_INT_MAX / 100 - 100), new Currency('USD')));
    }
}

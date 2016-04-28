<?php

namespace Tests;

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
                Money::create(4, new Currency('USD')),
                Money::create(2, new Currency('USD')),
                Money::create(2, new Currency('USD')),
            ],
            [
                Money::create(5.55, new Currency('USD')),
                Money::create(5.55, new Currency('USD')),
                Money::create(0, new Currency('USD')),
            ],
            [
                Money::create(3.33, new Currency('USD')),
                Money::create(2.22, new Currency('USD')),
                Money::create(1.11, new Currency('USD')),
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
                Money::create(5, new Currency('USD')),
                Money::create(2, new Currency('USD')),
                Money::create(2, new Currency('USD')),
            ],
            [
                Money::create(3.50, new Currency('USD')),
                Money::create(2.50, new Currency('USD')),
                Money::create(1.50, new Currency('USD')),
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
                Money::create(2, new Currency('EUR')),
                Money::create(2, new Currency('USD')),
            ],
            [
                Money::create(2, new Currency('USD')),
                Money::create(2, new Currency('EUR')),
            ],
        ];
    }

    /**
     * @test
     */
    public function throwsRangeExceptionWhenAmountIsTooSmall()
    {
        $this->expectException(\RangeException::class);

        Money::create(-100, new Currency('USD'))
            ->subtract(Money::create((int) (PHP_INT_MAX / 100), new Currency('USD')));
    }
}

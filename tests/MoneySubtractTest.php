<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::subtract
 */
class MoneySubtractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctSubtractMoneyProvider
     * @param Money $base
     * @param Money $subtracted
     * @param Money $expected
     * @test
     */
    public function correctSubtractMoney(Money $base, Money $subtracted, Money $expected)
    {
        $this->assertTrue($expected->isEqual($base->subtract($subtracted)));
    }

    /**
     * @return array
     */
    public function correctSubtractMoneyProvider()
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
     * @dataProvider incorrectSubtractMoneyProvider
     * @param Money $base
     * @param Money $subtracted
     * @param Money $expected
     * @test
     */
    public function incorrectSubtractMoney(Money $base, Money $subtracted, Money $expected)
    {
        $this->assertFalse($expected->isEqual($base->subtract($subtracted)));
    }

    /**
     * @return array
     */
    public function incorrectSubtractMoneyProvider()
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
     * @dataProvider incorrectArgumentsInSubtractMoneyProvider
     * @param Money $base
     * @param Money $subtracted
     * @param Money $expected
     * @test
     */
    public function incorrectArgumentsInSubtractMoney(Money $base, Money $subtracted, Money $expected)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertFalse($expected->isEqual($base->subtract($subtracted)));
    }

    /**
     * @return array
     */
    public function incorrectArgumentsInSubtractMoneyProvider()
    {
        return [
            [
                new Money(2, new Currency('EUR')),
                new Money(2, new Currency('USD')),
                new Money(4, new Currency('USD')),
            ],
            [
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('EUR')),
                new Money(4, new Currency('USD')),
            ],
        ];
    }

    /**
     * @test
     */
    public function subtractOverflowException()
    {
        $this->expectException(\OverflowException::class);

        (new Money(-20, new Currency('USD')))
            ->subtract(new Money(PHP_INT_MAX / 100, new Currency('USD')));
    }
}

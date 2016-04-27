<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::add
 * @covers \KubaWerlos\Money\Money::<private>
 */
class MoneyAddTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctAddMoneyProvider
     * @param Money $base
     * @param Money $added
     * @param Money $expected
     * @test
     */
    public function correctAddMoney(Money $base, Money $added, Money $expected)
    {
        $this->assertTrue($expected->isEqual($base->add($added)));
    }

    /**
     * @return array
     */
    public function correctAddMoneyProvider()
    {
        return [
            [
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('USD')),
                new Money(4, new Currency('USD')),
            ],
            [
                new Money(25.50, new Currency('EUR')),
                new Money(10.99, new Currency('EUR')),
                new Money(36.49, new Currency('EUR')),
            ],
            [
                new Money(16.40, new Currency('PLN')),
                new Money(10.20, new Currency('PLN')),
                new Money(26.60, new Currency('PLN')),
            ],
            [
                new Money(46.40, new Currency('PLN')),
                new Money(-8.10, new Currency('PLN')),
                new Money(38.30, new Currency('PLN')),
            ],
            [
                new Money(-8.00, new Currency('PLN')),
                new Money(8.00, new Currency('PLN')),
                new Money(0, new Currency('PLN')),
            ],
        ];
    }

    /**
     * @dataProvider incorrectAddMoneyProvider
     * @param Money $base
     * @param Money $added
     * @param Money $expected
     * @test
     */
    public function incorrectAddMoney(Money $base, Money $added, Money $expected)
    {
        $this->assertFalse($expected->isEqual($base->add($added)));
    }

    /**
     * @return array
     */
    public function incorrectAddMoneyProvider()
    {
        return [
            [
                new Money(2, new Currency('USD')),
                new Money(2, new Currency('USD')),
                new Money(5, new Currency('USD')),
            ],
            [
                new Money(1.50, new Currency('USD')),
                new Money(2.50, new Currency('USD')),
                new Money(3.50, new Currency('USD')),
            ],
        ];
    }

    /**
     * @dataProvider incorrectArgumentsInAddMoneyProvider
     * @param Money $base
     * @param Money $added
     * @param Money $expected
     * @test
     */
    public function incorrectArgumentsInAddMoney(Money $base, Money $added, Money $expected)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertFalse($expected->isEqual($base->add($added)));
    }

    /**
     * @return array
     */
    public function incorrectArgumentsInAddMoneyProvider()
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

        (new Money(PHP_INT_MAX / 100, new Currency('USD')))
            ->add(new Money(PHP_INT_MAX / 100, new Currency('USD')));
    }
}

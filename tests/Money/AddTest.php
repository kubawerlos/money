<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::add
 * @covers \KubaWerlos\Money\Money::calculate
 */
class AddTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctAdditionProvider
     * @param Money $base
     * @param Money $added
     * @param Money $expected
     * @test
     */
    public function correctAddition(Money $base, Money $added, Money $expected)
    {
        $this->assertTrue($expected->isEqual($base->add($added)));
    }

    /**
     * @return array
     */
    public function correctAdditionProvider()
    {
        return [
            [
                Money::create(2, new Currency('USD')),
                Money::create(2, new Currency('USD')),
                Money::create(4, new Currency('USD')),
            ],
            [
                Money::create(25.50, new Currency('EUR')),
                Money::create(10.99, new Currency('EUR')),
                Money::create(36.49, new Currency('EUR')),
            ],
            [
                Money::create(16.40, new Currency('PLN')),
                Money::create(10.20, new Currency('PLN')),
                Money::create(26.60, new Currency('PLN')),
            ],
            [
                Money::create(46.40, new Currency('PLN')),
                Money::create(-8.10, new Currency('PLN')),
                Money::create(38.30, new Currency('PLN')),
            ],
            [
                Money::create(-8.00, new Currency('PLN')),
                Money::create(8.00, new Currency('PLN')),
                Money::create(0, new Currency('PLN')),
            ],
        ];
    }

    /**
     * @dataProvider incorrectAdditionProvider
     * @param Money $base
     * @param Money $added
     * @param Money $expected
     * @test
     */
    public function incorrectAddition(Money $base, Money $added, Money $expected)
    {
        $this->assertFalse($expected->isEqual($base->add($added)));
    }

    /**
     * @return array
     */
    public function incorrectAdditionProvider()
    {
        return [
            [
                Money::create(2, new Currency('USD')),
                Money::create(2, new Currency('USD')),
                Money::create(5, new Currency('USD')),
            ],
            [
                Money::create(1.50, new Currency('USD')),
                Money::create(2.50, new Currency('USD')),
                Money::create(3.50, new Currency('USD')),
            ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotMatchingCurrenciesProvider
     * @param Money $base
     * @param Money $added
     * @test
     */
    public function throwInvalidArgumentExceptionForNotMatchingCurrencies(Money $base, Money $added)
    {
        $this->expectException(\InvalidArgumentException::class);

        $base->add($added);
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
    public function throwRangeExceptionWhenResultIsTooLarge()
    {
        $this->expectException(\RangeException::class);

        $money = Money::create((int) (PHP_INT_MAX / 100 - 100), new Currency('USD'));
        $money->add($money);
    }
}

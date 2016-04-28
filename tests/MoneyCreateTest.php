<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::__construct
 * @covers \KubaWerlos\Money\Money::<private>
 */
class MoneyCreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validMoneyProvider
     * @param float|int $amount
     * @param Currency $currency
     * @test
     */
    public function validMoney($amount, Currency $currency)
    {
        $this->assertInstanceOf(Money::class, Money::create($amount, $currency));
    }

    /**
     * @return array
     */
    public function validMoneyProvider()
    {
        return [
            [
                0,
                new Currency('USD'),
            ],
            [
                1000,
                new Currency('USD'),
            ],
            [
                12.34,
                new Currency('USD'),
            ],
            [
                -15,
                new Currency('USD'),
            ],
            [
                -5.5,
                new Currency('USD'),
            ],
        ];
    }

    /**
     * @dataProvider invalidMoneyProvider
     * @param mixed $amount
     * @test
     */
    public function invalidMoney($amount)
    {
        $this->expectException(\InvalidArgumentException::class);
        Money::create($amount, new Currency('USD'));
    }

    /**
     * @return array
     */
    public function invalidMoneyProvider()
    {
        return [
            [null],
            [true],
            [false],
            ['abc'],
            [123.456],
            [-12.345],
        ];
    }
}

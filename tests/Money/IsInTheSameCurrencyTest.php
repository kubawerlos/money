<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::isInTheSameCurrency
 */
class IsInTheSameCurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sameCurrencyProvider
     * @param Money $money1
     * @param Money $money2
     * @test
     */
    public function sameCurrency(Money $money1, Money $money2)
    {
        $this->assertTrue($money1->isInTheSameCurrency($money1));
        $this->assertTrue($money1->isInTheSameCurrency($money2));
        $this->assertTrue($money2->isInTheSameCurrency($money1));
    }

    /**
     * @return array
     */
    public function sameCurrencyProvider()
    {
        return [
            [
                new Money(10, new Currency('USD')),
                new Money(50, new Currency('USD')),
            ],
            [
                new Money(5.5, new Currency('EUR')),
                new Money(200, new Currency('EUR')),
            ],
            [
                new Money(-2, new Currency('EUR')),
                new Money(22, new Currency('EUR')),
            ],
        ];
    }

    /**
     * @dataProvider notSameCurrencyProvider
     * @param Money $money1
     * @param Money $money2
     * @test
     */
    public function notSameCurrency(Money $money1, Money $money2)
    {
        $this->assertFalse($money1->isInTheSameCurrency($money2));
        $this->assertFalse($money2->isInTheSameCurrency($money1));
    }

    /**
     * @return array
     */
    public function notSameCurrencyProvider()
    {
        return [
            [
                new Money(10, new Currency('USD')),
                new Money(10, new Currency('EUR')),
            ],
            [
                new Money(100, new Currency('USD')),
                new Money(100, new Currency('EUR')),
            ],
            [
                new Money(55, new Currency('USD')),
                new Money(-5, new Currency('EUR')),
            ],
        ];
    }
}

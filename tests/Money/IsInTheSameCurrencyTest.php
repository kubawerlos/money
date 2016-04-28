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
                Money::create(10, new Currency('USD')),
                Money::create(50, new Currency('USD')),
            ],
            [
                Money::create(5.5, new Currency('EUR')),
                Money::create(200, new Currency('EUR')),
            ],
            [
                Money::create(-2, new Currency('EUR')),
                Money::create(22, new Currency('EUR')),
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
                Money::create(10, new Currency('USD')),
                Money::create(10, new Currency('EUR')),
            ],
            [
                Money::create(100, new Currency('USD')),
                Money::create(100, new Currency('EUR')),
            ],
            [
                Money::create(55, new Currency('USD')),
                Money::create(-5, new Currency('EUR')),
            ],
        ];
    }
}

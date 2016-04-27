<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::isEqual
 */
class MoneyIsEqualTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider equalMoneyProvider
     * @param Money $money1
     * @param Money $money2
     * @test
     */
    public function equalMoney(Money $money1, Money $money2)
    {
        $this->assertTrue($money1->isEqual($money1));
        $this->assertTrue($money1->isEqual($money2));
        $this->assertTrue($money2->isEqual($money1));
    }

    /**
     * @return array
     */
    public function equalMoneyProvider()
    {
        return [
            [
                new Money(0, new Currency('USD')),
                new Money(0, new Currency('USD')),
            ],
            [
                new Money(1000, new Currency('EUR')),
                new Money(1000, new Currency('EUR')),
            ],
            [
                new Money(2.5, new Currency('PLN')),
                new Money(2.5, new Currency('PLN')),
            ],
        ];
    }

    /**
     * @dataProvider notEqualMoneyProvider
     * @param Money $money1
     * @param Money $money2
     * @test
     */
    public function notEqualMoney(Money $money1, Money $money2)
    {
        $this->assertFalse($money1->isEqual($money2));
        $this->assertFalse($money2->isEqual($money1));
    }

    /**
     * @return array
     */
    public function notEqualMoneyProvider()
    {
        return [
            [
                new Money(0, new Currency('USD')),
                new Money(1, new Currency('USD')),
            ],
            [
                new Money(1000, new Currency('EUR')),
                new Money(1000, new Currency('PLN')),
            ],
            [
                new Money(2.5, new Currency('PLN')),
                new Money(50, new Currency('EUR')),
            ],
        ];
    }
}

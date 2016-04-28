<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::isEqual
 */
class IsEqualTest extends \PHPUnit_Framework_TestCase
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
                Money::create(0, new Currency('USD')),
                Money::create(0, new Currency('USD')),
            ],
            [
                Money::create(1000, new Currency('EUR')),
                Money::create(1000, new Currency('EUR')),
            ],
            [
                Money::create(2.5, new Currency('PLN')),
                Money::create(2.5, new Currency('PLN')),
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
                Money::create(0, new Currency('USD')),
                Money::create(1, new Currency('USD')),
            ],
            [
                Money::create(2, new Currency('USD')),
                Money::create(-2, new Currency('USD')),
            ],
            [
                Money::create(1000, new Currency('EUR')),
                Money::create(1000, new Currency('PLN')),
            ],
            [
                Money::create(-5, new Currency('PLN')),
                Money::create(-5, new Currency('EUR')),
            ],
        ];
    }
}

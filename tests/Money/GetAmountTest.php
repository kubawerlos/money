<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::getAmount
 */
class GetAmountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getAmountFormatProvider
     * @param float|int|string $amount
     * @param Money $money
     * @test
     */
    public function getAmountFormat($amount, Money $money)
    {
        $this->assertSame($amount, $money->getAmount());
    }

    /**
     * @return array
     */
    public function getAmountFormatProvider()
    {
        return [
            [ '0.00', new Money(0, new Currency('USD')) ],
            [ '1.00', new Money(1, new Currency('EUR')) ],
            [ '1.99', new Money(1.99, new Currency('PLN')) ],
            [ '-5.00', new Money(-5, new Currency('USD')) ],
            [ '-2.55', new Money(-2.55, new Currency('USD')) ],
            [ '1000.00', new Money(1000, new Currency('USD')) ],
            [ '0', new Money(0, new Currency('HUF')) ],
            [ '20', new Money(20, new Currency('HUF')) ],
            [ '-7', new Money(-7, new Currency('HUF')) ],
        ];
    }
}

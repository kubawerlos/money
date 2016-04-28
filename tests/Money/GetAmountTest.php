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
            [ '0.00', Money::create(0, new Currency('USD')) ],
            [ '1.00', Money::create(1, new Currency('EUR')) ],
            [ '1.99', Money::create(1.99, new Currency('PLN')) ],
            [ '-5.00', Money::create(-5, new Currency('USD')) ],
            [ '-2.55', Money::create(-2.55, new Currency('USD')) ],
            [ '1 000.00', Money::create(1000, new Currency('USD')) ],
            [ '1 000 000.00', Money::create(1000000, new Currency('USD')) ],
            [ '0', Money::create(0, new Currency('HUF')) ],
            [ '20', Money::create(20, new Currency('HUF')) ],
            [ '-7', Money::create(-7, new Currency('HUF')) ],
        ];
    }
}

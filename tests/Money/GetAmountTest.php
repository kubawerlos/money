<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Money::getAmount
 */
class GetAmountTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getAmountFormatProvider
     * @param string $expectedAmount
     * @param int|float|string $unitAmount
     * @param string $currencyCode
     * @test
     */
    public function getAmountFormat($expectedAmount, $unitAmount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $money = new Money($unitAmount, $currency);

        $amount = $money->getAmount();

        $this->assertSame($expectedAmount, $amount);
    }

    /**
     * @return array
     */
    public function getAmountFormatProvider()
    {
        return array(
            array( '0.00', 0, 'USD'),
            array( '1.00', 1, 'EUR'),
            array( '1.80', 1.8, 'PLN'),
            array( '1.99', 1.99, 'PLN'),
            array( '-5.00', -5, 'USD'),
            array( '-2.55', '-2.55', 'USD'),
            array( '1000.00', 1000, 'USD'),
            array( '0', '0', 'HUF'),
            array( '20', 20, 'HUF'),
            array( '-7', -7, 'HUF'),
        );
    }
}

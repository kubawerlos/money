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
        return [
            [ '0.00', 0, 'USD'],
            [ '1.00', 1, 'EUR'],
            [ '1.80', 1.8, 'PLN'],
            [ '1.99', 1.99, 'PLN'],
            [ '-5.00', -5, 'USD'],
            [ '-2.55', '-2.55', 'USD'],
            [ '1000.00', 1000, 'USD'],
            [ '0', '0', 'HUF'],
            [ '20', 20, 'HUF'],
            [ '-7', -7, 'HUF'],
        ];
    }
}

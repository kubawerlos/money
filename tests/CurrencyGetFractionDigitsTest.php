<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use Symfony\Component\Intl\Intl;

/**
 * @covers \KubaWerlos\Money\Currency::getFractionDigits
 */
class CurrencyGetFractionDigitsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getFractionDigitsProvider
     * @param int $expected
     * @param Currency $currency
     * @test
     */
    public function getFractionDigits($expected, Currency $currency)
    {
        $this->assertSame($expected, $currency->getFractionDigits());
    }

    /**
     * @return array
     */
    public function getFractionDigitsProvider()
    {
        return [
            [
                2,
                new Currency('USD'),
            ],
            [
                2,
                new Currency('EUR'),
            ],
            [
                2,
                new Currency('PLN'),
            ],
            [
                0,
                new Currency('HUF'),
            ],
        ];
    }
}

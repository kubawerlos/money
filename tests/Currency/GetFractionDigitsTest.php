<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Currency::getFractionDigits
 */
class GetFractionDigitsTest extends \PHPUnit_Framework_TestCase
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
            [ 2, new Currency('USD') ],
            [ 2, new Currency('EUR') ],
            [ 2, new Currency('PLN') ],
            [ 0, new Currency('HUF') ],
        ];
    }
}

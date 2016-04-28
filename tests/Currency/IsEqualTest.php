<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Currency::isEqual
 */
class IsEqualTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider equalCurrenciesProvider
     * @param Currency $currency1
     * @param Currency $currency2
     * @test
     */
    public function equalCurrencies(Currency $currency1, Currency $currency2)
    {
        $this->assertTrue($currency1->isEqual($currency1));
        $this->assertTrue($currency1->isEqual($currency2));
        $this->assertTrue($currency2->isEqual($currency1));
    }

    /**
     * @return array
     */
    public function equalCurrenciesProvider()
    {
        return [
            [
                new Currency('EUR'),
                new Currency('EUR'),
            ],
            [
                new Currency('PLN'),
                new Currency('PLN'),
            ],
        ];
    }

    /**
     * @dataProvider notEqualCurrenciesProvider
     * @param Currency $currency1
     * @param Currency $currency2
     * @test
     */
    public function notEqualCurrencies(Currency $currency1, Currency $currency2)
    {
        $this->assertFalse($currency1->isEqual($currency2));
        $this->assertFalse($currency2->isEqual($currency1));
    }

    /**
     * @return array
     */
    public function notEqualCurrenciesProvider()
    {
        return [
            [
                new Currency('USD'),
                new Currency('PLN'),
            ],
            [
                new Currency('EUR'),
                new Currency('USD'),
            ],
        ];
    }
}

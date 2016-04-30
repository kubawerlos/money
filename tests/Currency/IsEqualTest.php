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
     * @param string $code1
     * @param string $code2
     * @test
     */
    public function equalCurrencies($code1, $code2)
    {
        $currency1 = new Currency($code1);
        $currency2 = new Currency($code2);

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
            [ 'USD', 'USD' ],
            [ 'HUF', 'HUF' ],
        ];
    }

    /**
     * @dataProvider notEqualCurrenciesProvider
     * @param string $code1
     * @param string $code2
     * @test
     */
    public function notEqualCurrencies($code1, $code2)
    {
        $currency1 = new Currency($code1);
        $currency2 = new Currency($code2);

        $this->assertFalse($currency1->isEqual($currency2));
        $this->assertFalse($currency2->isEqual($currency1));
    }

    /**
     * @return array
     */
    public function notEqualCurrenciesProvider()
    {
        return [
            [ 'USD', 'EUR' ],
            [ 'PLN', 'HUF' ],
        ];
    }
}

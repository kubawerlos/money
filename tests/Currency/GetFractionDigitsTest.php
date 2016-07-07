<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Currency::getFractionDigits
 */
class GetFractionDigitsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getFractionDigitsProvider
     * @param int $expectedFractionDigits
     * @param string $code
     * @test
     */
    public function getFractionDigits($expectedFractionDigits, $code)
    {
        $currency = new Currency($code);

        $actualFractionDigits = $currency->getFractionDigits();

        $this->assertSame($expectedFractionDigits, $actualFractionDigits);
    }

    /**
     * @return array
     */
    public function getFractionDigitsProvider()
    {
        $xml = simplexml_load_file('http://www.currency-iso.org/dam/downloads/lists/list_one.xml');

        $currencies = [];

        foreach ($xml->CcyTbl->children() as $child) {
            if (!empty($child->Ccy)) {
                $currencies[] = [ intval($child->CcyMnrUnts), strval($child->Ccy) ];
            }
        }

        return $currencies;
    }
}

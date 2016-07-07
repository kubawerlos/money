<?php

namespace Tests\Converter;

use InvalidArgumentException;
use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Converter::__construct
 * @covers KubaWerlos\Money\Converter::getUnitFromSubunit
 */
class GetUnitFromSubunitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctConversionProvider
     * @param string $expectedUnit
     * @param int $subunit
     * @param string $currencyCode
     * @test
     */
    public function correctConversion($expectedUnit, $subunit, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $converter = new Converter($currency);

        $actualUnit = $converter->getUnitFromSubunit($subunit);

        $this->assertSame($expectedUnit, $actualUnit);
    }

    /**
     * @return array
     */
    public function correctConversionProvider()
    {
        return [
            [ '0.00', 0, 'USD' ],
            [ '2.00', 200, 'USD' ],
            [ '5.50', 550, 'USD' ],
            [ '-2.55', -255, 'USD' ],
            [ '12.00', 1200, 'USD' ],
            [ '1000.00', 100000, 'USD' ],
            [ '-0.07', -7, 'USD' ],
            [ '0', 0, 'JPY' ],
            [ '20', 20, 'JPY' ],
            [ '-500', -500, 'JPY' ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotCorrectConversionProvider
     * @param mixed $subunit
     * @param string $currencyCode
     * @test
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversion($subunit, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $converter = new Converter($currency);

        $this->expectException(InvalidArgumentException::class);

        $converter->getUnitFromSubunit($subunit);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return [
            [ null, 'USD' ],
            [ true, 'EUR' ],
            [ 0.0, 'PLN' ],
            [ '10', 'TRY' ],
            [ '1.99', 'JPY' ],
        ];
    }
}

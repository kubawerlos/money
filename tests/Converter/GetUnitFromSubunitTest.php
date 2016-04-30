<?php

namespace Tests\Converter;

use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Converter::__construct
 * @covers \KubaWerlos\Money\Converter::getUnitFromSubunit
 */
class GetUnitFromSubunitTest extends \PHPUnit_Framework_TestCase
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
        return array(
            array( '0.00', 0, 'USD' ),
            array( '2.00', 200, 'USD' ),
            array( '5.50', 550, 'USD' ),
            array( '-2.55', -255, 'USD' ),
            array( '12.00', 1200, 'USD' ),
            array( '1000.00', 100000, 'USD' ),
            array( '-0.07', -7, 'USD' ),
            array( '0', 0, 'HUF' ),
            array( '20', 20, 'HUF' ),
            array( '-500', -500, 'HUF' ),
        );
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

        $this->setExpectedException(\InvalidArgumentException::class);

        $converter->getUnitFromSubunit($subunit);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return array(
            array( null, 'USD' ),
            array( true, 'EUR' ),
            array( 0.0, 'PLN' ),
            array( '10', 'TRY' ),
            array( '1.99', 'HUF' ),
        );
    }
}

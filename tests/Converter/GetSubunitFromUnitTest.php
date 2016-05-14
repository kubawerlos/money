<?php

namespace Tests\Converter;

use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;

/**
 * @covers KubaWerlos\Money\Converter::__construct
 * @covers KubaWerlos\Money\Converter::getSubunitFromUnit
 * @covers KubaWerlos\Money\Converter::<private>
 */
class GetSubunitFromUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctConversionProvider
     * @param int $expectedSubunit
     * @param string $unit
     * @param string $currencyCode
     * @test
     */
    public function correctConversion($expectedSubunit, $unit, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $converter = new Converter($currency);

        $actualSubunit = $converter->getSubunitFromUnit($unit);

        $this->assertSame($expectedSubunit, $actualSubunit);
    }

    /**
     * @return array
     */
    public function correctConversionProvider()
    {
        return array(
            array( 0, '0', 'USD' ),
            array( 50, '0.5', 'USD' ),
            array( 199, '1.99', 'USD' ),
            array( -105500, '-1055', 'USD' ),
            array( -255, '-2.55', 'USD' ),
            array( 10000000, '100000', 'USD' ),
            array( 0, '0', 'HUF' ),
            array( 20, '20', 'HUF' ),
            array( -500, '-500', 'HUF' ),
        );
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotCorrectConversionProvider
     * @param mixed $unit
     * @param string $currencyCode
     * @test
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversion($unit, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $converter = new Converter($currency);

        $this->setExpectedException('InvalidArgumentException');

        $converter->getSubunitFromUnit($unit);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return array(
            array( null, 'USD' ),
            array( true, 'USD' ),
            array( false, 'USD' ),
            array( '', 'USD' ),
            array( 'abc', 'USD' ),
            array( array(1, 2), 'USD' ),
            array( 123.456, 'USD' ),
            array( -12.345, 'USD' ),
            array( '7 Dollars', 'USD' ),
            array( '01', 'USD' ),
            array( '00.5', 'USD' ),
            array( '-00.99', 'USD' ),
            array( '0.500', 'USD' ),
            array( '12.', 'USD' ),
            array( '1/2', 'USD' ),
            array( '5,5', 'USD' ),
            array( '1.2.3', 'USD' ),
            array( '1,2.3', 'USD' ),
            array( log(0), 'USD' ),
            array( acos(1.01), 'USD' ),
            array( '0.5', 'HUF' ),
            array( '2.', 'HUF' ),
            array( '--4', 'HUF' ),
        );
    }
}

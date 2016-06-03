<?php

namespace Tests\Converter;

use InvalidArgumentException;
use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Converter::__construct
 * @covers KubaWerlos\Money\Converter::getSubunitFromUnit
 * @covers KubaWerlos\Money\Converter::<private>
 */
class GetSubunitFromUnitTest extends PHPUnit_Framework_TestCase
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
        return [
            [ 0, '0', 'USD' ],
            [ 50, '0.5', 'USD' ],
            [ 199, '1.99', 'USD' ],
            [ -105500, '-1055', 'USD' ],
            [ -255, '-2.55', 'USD' ],
            [ 10000000, '100000', 'USD' ],
            [ 0, '0', 'ITL' ],
            [ 20, '20', 'ITL' ],
            [ -500, '-500', 'ITL' ],
        ];
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

        $this->expectException(InvalidArgumentException::class);

        $converter->getSubunitFromUnit($unit);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return [
            [ null, 'USD' ],
            [ true, 'USD' ],
            [ false, 'USD' ],
            [ '', 'USD' ],
            [ 'abc', 'USD' ],
            [ [1, 2], 'USD' ],
            [ 123.456, 'USD' ],
            [ -12.345, 'USD' ],
            [ '7 Dollars', 'USD' ],
            [ '01', 'USD' ],
            [ '00.5', 'USD' ],
            [ '-00.99', 'USD' ],
            [ '0.500', 'USD' ],
            [ '12.', 'USD' ],
            [ '1/2', 'USD' ],
            [ '5,5', 'USD' ],
            [ '1.2.3', 'USD' ],
            [ '1,2.3', 'USD' ],
            [ log(0), 'USD' ],
            [ acos(1.01), 'USD' ],
            [ '0.5', 'ITL' ],
            [ '2.', 'ITL' ],
            [ '--4', 'ITL' ],
        ];
    }
}

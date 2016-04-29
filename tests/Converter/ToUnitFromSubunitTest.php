<?php

namespace Tests\Converter;

use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Converter::__construct
 * @covers \KubaWerlos\Money\Converter::toUnitFromSubunit
 */
class ToUnitFromSubunitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctConversionProvider
     * @param string $currencyCode
     * @param int $subunit
     * @param string $expectedUnit
     * @test
     */
    public function correctConversion($currencyCode, $subunit, $expectedUnit)
    {
        $converter = new Converter(new Currency($currencyCode));
        $converted = $converter->toUnitFromSubunit($subunit);

        $this->assertSame($expectedUnit, $converted);
    }

    /**
     * @return array
     */
    public function correctConversionProvider()
    {
        return [
            [ 'USD', 0, '0.00' ],
            [ 'USD', 200, '2.00' ],
            [ 'USD', 550, '5.50' ],
            [ 'USD', -255, '-2.55' ],
            [ 'USD', 1200, '12.00' ],
            [ 'USD', 100000, '1000.00' ],
            [ 'HUF', 0, '0' ],
            [ 'HUF', 20, '20' ],
            [ 'HUF', -500, '-500' ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotCorrectConversionProvider
     * @param string $currencyCode
     * @param int $subunit
     * @test
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversion($currencyCode, $subunit)
    {
        $converter = new Converter(new Currency($currencyCode));

        $this->expectException(\InvalidArgumentException::class);

        $converter->toUnitFromSubunit($subunit);

    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return [
            [ 'USD', 0.0 ],
            [ 'PLN', '12.5' ],
            [ 'HUF', '0.5' ],
        ];
    }
}

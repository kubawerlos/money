<?php

namespace Tests\Converter;

use KubaWerlos\Money\Converter;
use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Converter::__construct
 * @covers \KubaWerlos\Money\Converter::toSubunitFromUnit
 * @covers \KubaWerlos\Money\Converter::<private>
 */
class ToSubunitFromUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctConversionProvider
     * @param string $currencyCode
     * @param int $unit
     * @param string $expectedSubunit
     * @test
     */
    public function correctConversion($currencyCode, $unit, $expectedSubunit)
    {
        $converter = new Converter(new Currency($currencyCode));
        $converted = $converter->toSubunitFromUnit($unit);

        $this->assertSame($expectedSubunit, $converted);
    }

    /**
     * @return array
     */
    public function correctConversionProvider()
    {
        return [
            [ 'USD', '0', 0 ],
            [ 'USD', '1', 100 ],
            [ 'USD', '1.99', 199 ],
            [ 'USD', '-1055', -105500 ],
            [ 'USD', '-2.55', -255 ],
            [ 'USD', '100000', 10000000 ],
            [ 'HUF', '0', 0 ],
            [ 'HUF', '20', 20 ],
            [ 'HUF', '-500', -500 ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForNotCorrectConversionProvider
     * @param string $currencyCode
     * @param int $unit
     * @test
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversion($currencyCode, $unit)
    {
        $converter = new Converter(new Currency($currencyCode));

        $this->expectException(\InvalidArgumentException::class);

        $converter->toSubunitFromUnit($unit);

    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForNotCorrectConversionProvider()
    {
        return [
            [ 'USD', null ],
            [ 'USD', true ],
            [ 'USD', false ],
            [ 'USD', log(0)],
            [ 'HUF', '0.5' ],
        ];
    }
}

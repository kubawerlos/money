<?php

namespace Tests\Currency;

use InvalidArgumentException;
use KubaWerlos\Money\Currency;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Currency::__construct
 * @covers KubaWerlos\Money\Currency::<private>
 */
class ConstructorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validCurrencyProvider
     * @param string $code
     * @test
     */
    public function validCurrency($code)
    {
        $currency = new Currency($code);

        $this->assertInstanceOf('KubaWerlos\Money\Currency', $currency);
    }

    /**
     * @return array
     */
    public function validCurrencyProvider()
    {
        return [
            [ 'USD' ],
            [ 'EUR' ],
            [ 'PLN' ],
            [ 'TRY' ],
            [ 'HUF' ],
            [ 'JPY' ],
            [ 'GBP' ],
            [ 'AUD' ],
            [ 'CHF' ],
            [ 'CAD' ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForInvalidCurrencyProvider
     * @param mixed $code
     * @test
     */
    public function throwInvalidArgumentExceptionForInvalidCurrency($code)
    {
        $this->expectException(InvalidArgumentException::class);

        new Currency($code);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForInvalidCurrencyProvider()
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ 42 ],
            [ 2.5 ],
            [ [1, 2] ],
            [ 'USDSuffix' ],
            [ '' ],
            [ 'pln' ],
            [ 'Euro' ],
            [ 'Polish Zloty' ],
            [ 'FBI' ],
            [ 'USA' ],
            [ '5,5' ],
            [ '1,2.3', ],
            [ '2.' ],
            [ log(0) ],
            [ acos(1.01) ],
        ];
    }
}

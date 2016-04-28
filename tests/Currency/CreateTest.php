<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Currency::__construct
 * @covers \KubaWerlos\Money\Currency::<private>
 */
class CreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validCurrencyProvider
     * @param string $code
     * @test
     */
    public function validCurrency($code)
    {
        $this->assertInstanceOf(Currency::class, new Currency($code));
    }

    /**
     * @return array
     */
    public function validCurrencyProvider()
    {
        return [
            ['USD'],
            ['EUR'],
            ['PLN'],
            ['HUF'],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForInvalidCurrencyProvider
     * @param mixed $code
     * @test
     */
    public function throwInvalidArgumentExceptionForInvalidCurrency($code)
    {
        $this->expectException(\InvalidArgumentException::class);

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
            [ 123.456 ],
            [ 'Euro' ],
            [ 'Polish Zloty' ],
            [ 'CIA' ],
            [ 'FBI' ],
            [ 'USA' ],
        ];
    }
}

<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Currency::__construct
 */
class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validCurrencyProvider
     * @param string $code
     * @test
     */
    public function validCurrency($code)
    {
        $currency = new Currency($code);

        $this->assertInstanceOf(Currency::class, $currency);
    }

    /**
     * @return array
     */
    public function validCurrencyProvider()
    {
        return array(
            array( 'USD' ),
            array( 'EUR' ),
            array( 'PLN' ),
            array( 'TRY' ),
            array( 'HUF' ),
            array( 'JPY' ),
            array( 'GBP' ),
            array( 'AUD' ),
            array( 'CHF' ),
            array( 'CAD' ),
        );
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForInvalidCurrencyProvider
     * @param mixed $code
     * @test
     */
    public function throwInvalidArgumentExceptionForInvalidCurrency($code)
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        new Currency($code);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForInvalidCurrencyProvider()
    {
        return array(
            array( null ),
            array( true ),
            array( false ),
            array( 42 ),
            array( 2.5 ),
            array( array(1, 2) ),
            array( 'USDSuffix' ),
            array( '' ),
            array( 'pln' ),
            array( 'Euro' ),
            array( 'Polish Zloty' ),
            array( 'FBI' ),
            array( 'USA' ),
            array( '5,5' ),
            array( '1,2.3', ),
            array( '2.' ),
            array( log(0) ),
            array( acos(1.01) ),
        );
    }
}

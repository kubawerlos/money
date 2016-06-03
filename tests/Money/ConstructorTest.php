<?php

namespace Tests\Money;

use InvalidArgumentException;
use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Money::__construct
 */
class ConstructorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validMoneyProvider
     * @param float|int|string $amount
     * @param string $currencyCode
     * @test
     */
    public function validMoney($amount, $currencyCode)
    {
        $currency = new Currency($currencyCode);

        $money = new Money($amount, $currency);

        $this->assertInstanceOf('KubaWerlos\Money\Money', $money);
    }

    /**
     * @return array
     */
    public function validMoneyProvider()
    {
        return array(
            array( 0, 'USD' ),
            array( '0', 'USD' ),
            array( 0.0, 'USD' ),
            array( '0.0', 'USD' ),
            array( 1000, 'EUR' ),
            array( '1000', 'EUR' ),
            array( 1.99, 'PLN' ),
            array( '1.99', 'PLN' ),
            array( -20, 'HUF' ),
            array( '-20', 'HUF' ),
            array( -1.3, 'TRY' ),
            array( '-1.3', 'TRY' ),
            array( -1.55, 'TRY' ),
            array( '-1.55', 'TRY' ),
        );
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForInvalidAmountProvider
     * @param mixed $amount
     * @param string $currencyCode
     * @test
     */
    public function throwInvalidArgumentExceptionForInvalidAmount($amount, $currencyCode)
    {
        $currency = new Currency($currencyCode);

        $this->expectException(InvalidArgumentException::class);

        new Money($amount, $currency);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForInvalidAmountProvider()
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
            array( '1,2.3', 'USD' ),
            array( log(0), 'USD' ),
            array( acos(1.01), 'USD' ),
            array( '0.5', 'HUF' ),
            array( '2.', 'HUF' ),
        );
    }
}

<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::__construct
 */
class ConstructorTest extends \PHPUnit_Framework_TestCase
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

        $this->assertInstanceOf(Money::class, $money);
    }

    /**
     * @return array
     */
    public function validMoneyProvider()
    {
        return [
            [ 0, 'USD' ],
            [ '0', 'USD' ],
            [ 0.0, 'USD' ],
            [ '0.0', 'USD' ],
            [ 1000, 'EUR' ],
            [ '1000', 'EUR' ],
            [ 1.99, 'PLN' ],
            [ '1.99', 'PLN' ],
            [ -20, 'HUF' ],
            [ '-20', 'HUF' ],
            [ -1.3, 'TRY' ],
            [ '-1.3', 'TRY' ],
            [ -1.55, 'TRY' ],
            [ '-1.55', 'TRY' ],
        ];
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

        $this->expectException(\InvalidArgumentException::class);

        new Money($amount, $currency);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForInvalidAmountProvider()
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
//            [ '-00.99', 'USD' ], // TODO: fix this
            [ '0.500', 'USD' ],
            [ '12.', 'USD' ],
            [ '1/2', 'USD' ],
            [ '5,5', 'USD' ],
            [ '1,2.3', 'USD' ],
            [ log(0), 'USD' ],
            [ acos(1.01), 'USD' ],
            [ '0.5', 'HUF' ],
            [ '2.', 'HUF' ],
        ];
    }
}
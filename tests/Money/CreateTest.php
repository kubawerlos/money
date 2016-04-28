<?php

namespace Tests\Money;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::create
 * @covers \KubaWerlos\Money\Money::<private>
 */
class CreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validMoneyProvider
     * @param float|int|string $amount
     * @param Currency $currency
     * @test
     */
    public function validMoney($amount, Currency $currency)
    {
        $this->assertInstanceOf(Money::class, Money::create($amount, $currency));
    }

    /**
     * @return array
     */
    public function validMoneyProvider()
    {
        return [
            [ '0', new Currency('USD') ],
            [ 0.0, new Currency('USD') ],
            [ '0.0', new Currency('USD') ],
            [ '1000', new Currency('EUR') ],
            [ 1.99, new Currency('PLN') ],
            [ '1.99', new Currency('PLN') ],
            [ -20, new Currency('HUF') ],
            [ '-20', new Currency('HUF') ],
            [ -1.55, new Currency('TRY') ],
            [ '-1.55', new Currency('TRY') ],
        ];
    }

    /**
     * @dataProvider throwInvalidArgumentExceptionForInvalidAmountProvider
     * @param mixed $amount
     * @param Currency $currency
     * @test
     */
    public function throwInvalidArgumentExceptionForInvalidAmount($amount, Currency $currency)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertInstanceOf(Money::class, Money::create($amount, $currency));
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionForInvalidAmountProvider()
    {
        return [
            [ null, new Currency('USD') ],
            [ true, new Currency('USD') ],
            [ false, new Currency('USD') ],
            [ '', new Currency('USD') ],
            [ 2.5, new Currency('HUF') ],
            [ -12.345, new Currency('TRY') ],
            [ '01', new Currency('USD') ],
            [ '0.500', new Currency('USD') ],
            [ '10.', new Currency('USD') ],
            [ '5,5', new Currency('USD') ],
        ];
    }
}

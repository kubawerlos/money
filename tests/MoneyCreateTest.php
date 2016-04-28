<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

/**
 * @covers \KubaWerlos\Money\Money::create
 * @covers \KubaWerlos\Money\Money::getAmount
 * @covers \KubaWerlos\Money\Money::<private>
 */
class MoneyCreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validMoneyProvider
     * @param float|int|string $amount
     * @param Currency $currency
     * @test
     */
    public function validMoney($amount, Currency $currency)
    {
        $this->assertSame(
            number_format($amount, $currency->getFractionDigits(), '.', ' '),
            Money::create($amount, $currency)->getAmount()
        );
    }

    /**
     * @return array
     */
    public function validMoneyProvider()
    {
        return [
            [ 0, new Currency('USD') ],
            [ '0', new Currency('USD') ],
            [ 0.0, new Currency('USD') ],
            [ '0.0', new Currency('USD') ],
            [ 1000, new Currency('EUR') ],
            [ '1000', new Currency('EUR') ],
            [ 1.99, new Currency('PLN') ],
            [ '1.99', new Currency('PLN') ],
            [ -20, new Currency('HUF') ],
            [ '-20', new Currency('HUF') ],
            [ -1.3, new Currency('TRY') ],
            [ '-1.3', new Currency('TRY') ],
            [ -1.55, new Currency('TRY') ],
            [ '-1.55', new Currency('TRY') ],
        ];
    }

    /**
     * @dataProvider invalidMoneyProvider
     * @param mixed $amount
     * @param Currency $currency
     * @test
     */
    public function invalidMoney($amount, Currency $currency)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertInstanceOf(Money::class, Money::create($amount, $currency));
    }

    /**
     * @return array
     */
    public function invalidMoneyProvider()
    {
        return [
            [ null, new Currency('USD') ],
            [ true, new Currency('USD') ],
            [ false, new Currency('USD') ],
            [ 'abc', new Currency('USD') ],
            [ 2.5, new Currency('HUF') ],
            [ 123.456, new Currency('HUF') ],
            [ -12.345, new Currency('TRY') ],
            [ '7 Dollars', new Currency('USD') ],
            [ '01', new Currency('USD') ],
            [ '00.5', new Currency('USD') ],
            [ '10.', new Currency('USD') ],
            [ '10.2', new Currency('HUF') ],
            [ '1.2.3', new Currency('USD') ],
        ];
    }
}

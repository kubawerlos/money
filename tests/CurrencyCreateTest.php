<?php

namespace Tests;

use KubaWerlos\Money\Currency;
use Symfony\Component\Intl\Intl;

/**
 * @covers \KubaWerlos\Money\Currency::__construct
 * @covers \KubaWerlos\Money\Currency::<private>
 */
class CurrencyCreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validCurrencyProvider
     * @param string $currencyCode
     * @test
     */
    public function validCurrency($currencyCode)
    {
        $this->assertInstanceOf(Currency::class, new Currency($currencyCode));
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
     * @dataProvider invalidCurrencyProvider
     * @param mixed $currencyCode
     * @test
     */
    public function invalidCurrency($currencyCode)
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency($currencyCode);
    }

    /**
     * @return array
     */
    public function invalidCurrencyProvider()
    {
        return [
            [null],
            [true],
            [false],
            [42],
            [123.456],
            ['Euro'],
            ['Polish Zloty'],
            ['CIA'],
            ['FBI'],
            ['USA'],
        ];
    }
}

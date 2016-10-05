<?php

namespace Tests;

use KubaWerlos\Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * @covers KubaWerlos\Money\Money
 */
class MoneyTest extends TestCase
{
    public function testGettingAmount()
    {
        $money = new Money('10.00', 'USD');
        $this->assertSame('10.00', $money->getAmount());
    }

    public function testEqualityToItself()
    {
        $money = new Money('10.00', 'USD');
        $this->assertTrue($money->isEqual($money));
    }

    public function testEqualityForTheSameAmount()
    {
        $money1 = new Money('10.00', 'USD');
        $money2 = new Money('10.00', 'USD');
        $this->assertTrue($money1->isEqual($money2));
    }

    public function testInequalityForTheDifferentAmount()
    {
        $money1 = new Money('11.00', 'USD');
        $money2 = new Money('11.01', 'USD');
        $this->assertFalse($money1->isEqual($money2));
    }

    public function testAdditionForDifferentCurrencies()
    {
        $baseMoney = new Money(1, 'USD');
        $addedMoney = new Money(1, 'EUR');
        $this->expectException(\InvalidArgumentException::class);
        $baseMoney->add($addedMoney);
    }

    public function testCorrectAddition()
    {
        $baseMoney = new Money(10, 'USD');
        $addedMoney = new Money(12.5, 'USD');
        $expectedMoney = new Money('22.50', 'USD');
        $actualMoney = $baseMoney->add($addedMoney);
        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    public function testMultiplicationByBoolean()
    {
        $money = new Money('10.00', 'USD');
        $this->expectException(\InvalidArgumentException::class);
        $money->multiply(true);
    }

    public function testMultiplicationByFloat()
    {
        $money = new Money(12, 'USD');
        $expectedMoney = new Money(18, 'USD');
        $actualMoney = $money->multiply(1.5);
        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    public function testMultiplicationByInteger()
    {
        $money = new Money(5, 'USD');
        $expectedMoney = new Money(15, 'USD');
        $actualMoney = $money->multiply(3);
        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    public function testSubtraction()
    {
        $baseMoney = new Money(40, 'USD');
        $addedMoney = new Money(3, 'USD');
        $expectedMoney = new Money(37, 'USD');
        $actualMoney = $baseMoney->subtract($addedMoney);
        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    public function testDivisionByZero()
    {
        $money = new Money('10.00', 'USD');
        $this->expectException(\InvalidArgumentException::class);
        $money->divide(0);
    }

    public function testCorrectDivision()
    {
        $money = new Money(33, 'USD');
        $expectedMoney = new Money(11, 'USD');
        $actualMoney = $money->divide(3);
        $this->assertTrue($expectedMoney->isEqual($actualMoney));
    }

    public function testCalculationGoingOutOfRange()
    {
        $money = new Money((int) (PHP_INT_MAX / 100 - 100), 'USD');
        $this->expectException(\RangeException::class);
        $money->multiply(1000);
    }
}

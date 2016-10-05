<?php

namespace KubaWerlos\Money;

final class Money
{
    private $subunitAmount;

    private $currency;

    public function __construct($unitAmount, string $currencyCode)
    {
        $this->currency = new Currency($currencyCode);
        $this->subunitAmount = $this->currency->getSubunitAmountForUnitAmount($unitAmount);
    }

    public function getAmount() : string
    {
        return $this->currency->getUnitAmountForSubunitAmount($this->subunitAmount);
    }

    public function isEqual(self $money) : bool
    {
        return $this->isInTheSameCurrency($money) && $this->subunitAmount === $money->subunitAmount;
    }

    public function isInTheSameCurrency(self $money) : bool
    {
        return $this->currency->isEqual($money->currency);
    }

    public function add(self $money) : self
    {
        if (!$this->isInTheSameCurrency($money)) {
            throw new \InvalidArgumentException('Money is not in the same currency');
        }

        return $this->returnCalculation($this->subunitAmount + $money->subunitAmount);
    }

    public function multiply($multiplier) : self
    {
        if (!is_float($multiplier) && !is_int($multiplier)) {
            throw new \InvalidArgumentException('Multiplier must be float or integer');
        }

        return $this->returnCalculation($this->subunitAmount * $multiplier);
    }

    public function subtract(self $money) : self
    {
        return $this->add($money->multiply(-1));
    }

    public function divide($divisor) : self
    {
        if ($divisor == 0) {
            throw new \InvalidArgumentException('Division by zero');
        }

        return $this->multiply(1 / $divisor);
    }

    private function returnCalculation($subunitAmount) : self
    {
        if ($subunitAmount < PHP_INT_MIN || PHP_INT_MAX < $subunitAmount) {
            throw new \RangeException('Result of calculation is out integer range');
        }

        return new self(
            $this->currency->getUnitAmountForSubunitAmount((int) round($subunitAmount)),
            $this->currency->getCode()
        );
    }
}

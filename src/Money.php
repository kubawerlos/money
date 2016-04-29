<?php

namespace KubaWerlos\Money;

final class Money
{
    /** @var int */
    private $subunitAmount;

    /** @var Currency */
    private $currency;

    /**
     * @param float|int|string $unitAmount
     * @param Currency $currency
     * @throws \InvalidArgumentException
     */
    public function __construct($unitAmount, Currency $currency)
    {
        $this->subunitAmount = (new Converter($currency))->toSubunitFromUnit($unitAmount);
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return (new Converter($this->currency))->toUnitFromSubunit($this->subunitAmount);
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function isEqual(self $money)
    {
        return $this->isInTheSameCurrency($money)
            && $this->subunitAmount === $money->subunitAmount;
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function isInTheSameCurrency(self $money)
    {
        return $this->currency->isEqual($money->currency);
    }

    /**
     * @param Money $money
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    public function add(self $money)
    {
        return $this->calculate($money, 1);
    }

    /**
     * @param Money $money
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    public function subtract(self $money)
    {
        return $this->calculate($money, -1);
    }

    /**
     * @param Money $money
     * @param int $factor
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    private function calculate(self $money, $factor)
    {
        if (!$this->isInTheSameCurrency($money)) {
            throw new \InvalidArgumentException();
        }

        $subunitAmount = $this->subunitAmount + $factor * $money->subunitAmount;

        if (!is_int($subunitAmount)) {
            throw new \RangeException();
        }

        return new self((new Converter($this->currency))->toUnitFromSubunit($subunitAmount), $this->currency);
    }
}

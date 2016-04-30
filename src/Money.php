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
        $this->subunitAmount = (new Converter($currency))->getSubunitFromUnit($unitAmount);
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return (new Converter($this->currency))->getUnitFromSubunit($this->subunitAmount);
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
        if (!$this->isInTheSameCurrency($money)) {
            throw new \InvalidArgumentException();
        }

        return $this->returnCalculation($this->subunitAmount + $money->subunitAmount);
    }

    /**
     * @param int|float $multiplier
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    public function multiply($multiplier)
    {
        return $this->returnCalculation($this->subunitAmount * $multiplier);
    }

    /**
     * @param Money $money
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    public function subtract(self $money)
    {
        return $this->add($money->multiply(-1));
    }

    /**
     * @param int $subunitAmount
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return self
     */
    private function returnCalculation($subunitAmount)
    {
        // ~PHP_INT_MAX instead of PHP_INT_MIN for PHP 5.6
        if ($subunitAmount < ~PHP_INT_MAX || PHP_INT_MAX < $subunitAmount) {
            throw new \RangeException();
        }

        $converter = new Converter($this->currency);

        $unitAmount = $converter->getUnitFromSubunit((int) $subunitAmount);

        return new self($unitAmount, $this->currency);
    }
}

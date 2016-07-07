<?php

namespace KubaWerlos\Money;

use InvalidArgumentException;
use RangeException;

final class Money
{
    /** @var int */
    private $subunitAmount;

    /** @var Currency */
    private $currency;

    /**
     * @param float|int|string $unitAmount
     * @param string $currencyCode
     * @throws InvalidArgumentException
     */
    public function __construct($unitAmount, $currencyCode)
    {
        $this->currency = new Currency($currencyCode);
        $this->subunitAmount = (new Converter($this->currency))->getSubunitFromUnit($unitAmount);
    }

    /**
     * @throws InvalidArgumentException
     * @return string
     */
    public function getAmount()
    {
        $converter = new Converter($this->currency);

        return $converter->getUnitFromSubunit($this->subunitAmount);
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
     * @throws InvalidArgumentException
     * @throws RangeException
     * @return self
     */
    public function add(self $money)
    {
        if (!$this->isInTheSameCurrency($money)) {
            throw new InvalidArgumentException();
        }

        return $this->returnCalculation($this->subunitAmount + $money->subunitAmount);
    }

    /**
     * @param int|float $multiplier
     * @throws InvalidArgumentException
     * @throws RangeException
     * @return self
     */
    public function multiply($multiplier)
    {
        return $this->returnCalculation($this->subunitAmount * $multiplier);
    }

    /**
     * @param Money $money
     * @throws InvalidArgumentException
     * @throws RangeException
     * @return self
     */
    public function subtract(self $money)
    {
        return $this->add($money->multiply(-1));
    }

    /**
     * @param int|float $divisor
     * @throws InvalidArgumentException
     * @throws RangeException
     * @return self
     */
    public function divide($divisor)
    {
        if ($divisor == 0.0) {
            throw new InvalidArgumentException();
        }

        return $this->multiply(1 / $divisor);
    }

    /**
     * @param int $subunitAmount
     * @throws InvalidArgumentException
     * @throws RangeException
     * @return self
     */
    private function returnCalculation($subunitAmount)
    {
        // ~PHP_INT_MAX instead of PHP_INT_MIN for PHP < 7
        if ($subunitAmount < ~PHP_INT_MAX || PHP_INT_MAX < $subunitAmount) {
            throw new RangeException();
        }

        $converter = new Converter($this->currency);

        $unitAmount = $converter->getUnitFromSubunit((int) round($subunitAmount));

        return new self($unitAmount, $this->currency->getCode());
    }
}

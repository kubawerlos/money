<?php

namespace KubaWerlos\Money;

final class Money
{
    /** @var int */
    private $baseAmount;

    /** @var Currency */
    private $currency;

    /**
     * @param float|int|string $amount
     * @param Currency $currency
     * @throws \InvalidArgumentException
     * @return self
     */
    public static function create($amount, Currency $currency)
    {
        $baseAmount = self::calculateBaseAmount($amount, $currency);
        return new self($baseAmount, $currency);
    }

    /**
     * @param int $baseAmount
     * @param Currency $currency
     */
    private function __construct($baseAmount, Currency $currency)
    {
        $this->baseAmount = $baseAmount;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return number_format(
            $this->baseAmount / pow(10, $this->currency->getFractionDigits()),
            $this->currency->getFractionDigits(),
            '.',
            ' '
        );
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function isEqual(self $money)
    {
        return $this->isInTheSameCurrency($money) && $this->baseAmount === $money->baseAmount;
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
            throw new \InvalidArgumentException('Money have different currencies');
        }

        $baseAmount = $this->baseAmount + $factor * $money->baseAmount;

        if (!is_int($baseAmount)) {
            throw new \RangeException('Result of calculation is out of range');
        }

        return new self($baseAmount, $this->currency);
    }

    /**
     * @param float|int|string $amount
     * @param Currency $currency
     * @throws \InvalidArgumentException
     * @return int
     */
    private static function calculateBaseAmount($amount, Currency $currency)
    {
        if (!self::isValid($amount, $currency)) {
            throw new \InvalidArgumentException('Amount is invalid for this currency');
        }

        return (int) round(pow(10, $currency->getFractionDigits()) * $amount);
    }

    /**
     * @param float|int|string $amount
     * @param Currency $currency
     * @throws \InvalidArgumentException
     * @return bool
     */
    private static function isValid($amount, Currency $currency)
    {
        if (!is_int($amount) && !is_float($amount) && !is_string($amount)) {
            throw new \InvalidArgumentException('Amount is invalid');
        }

        return self::isMatchingMoneyPattern($amount, $currency->getFractionDigits())
            && preg_match('/^0\d+/', $amount) === 0;
    }

    /**
     * @param string $amount
     * @param int $fractionDigits
     * @throws \InvalidArgumentException
     * @return bool
     */
    private static function isMatchingMoneyPattern($amount, $fractionDigits)
    {
        $pattern = '-?\d+';

        if ($fractionDigits > 0) {
            $pattern .= sprintf('(\.\d{1,%d})?', $fractionDigits);
        }

        return preg_match('/^' . $pattern . '$/', $amount) > 0 ;
    }
}

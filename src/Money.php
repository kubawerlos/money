<?php

namespace KubaWerlos\Money;

final class Money
{
    /** @var int */
    private $amount;

    /** @var Currency */
    private $currency;

    /**
     * @param float|int $amount
     * @param Currency $currency
     * @throws \InvalidArgumentException
     */
    public function __construct($amount, Currency $currency)
    {
        $this->currency = $currency;
        $this->setAmount($amount);
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function isEqual(self $money)
    {
        return $this->isInTheSameCurrency($money) && $this->amount === $money->amount;
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
     * @return self
     */
    public function add(self $money)
    {
        if (!$this->isInTheSameCurrency($money)) {
            throw new \InvalidArgumentException('Different currencies');
        }

        $result = new self(0, $this->currency);

        $result->amount += $this->amount + $money->amount;

        if (!is_int($result->amount)) {
            throw new \OverflowException('Stack overflow');
        }

        return $result;
    }

    /**
     * @param Money $money
     * @throws \InvalidArgumentException
     * @return self
     */
    public function subtract(self $money)
    {
        $money->amount *= -1;
        return $this->add($money);
    }

    /**
     * @param float|int $amount
     * @throws \InvalidArgumentException
     */
    private function setAmount($amount)
    {
        if (!is_int($amount) && !is_float($amount)) {
            throw new \InvalidArgumentException('Money amount is invalid');
        }

        $newAmount = round($amount, $this->currency->getFractionDigits());

        if ((string) $amount !== (string) $newAmount) {
            throw new \InvalidArgumentException('Money amount is invalid for this currency');
        }

        $this->amount = (int) round(pow(10, $this->currency->getFractionDigits()) * $newAmount);
    }
}

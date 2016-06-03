<?php

namespace KubaWerlos\Money;

use InvalidArgumentException;
use Symfony\Component\Intl\Intl;

final class Currency
{
    /** @var string */
    private $code;

    /** @var int */
    private $fractionDigits;

    /**
     * @param string $code
     * @throws InvalidArgumentException
     */
    public function __construct($code)
    {
        if (!is_string($code)
            || !array_key_exists($code, Intl::getCurrencyBundle()->getCurrencyNames())) {
            throw new InvalidArgumentException();
        }
        $this->code = $code;

        $this->fractionDigits = (int) Intl::getCurrencyBundle()->getFractionDigits($this->code);
    }

    /**
     * @param Currency $currency
     * @return bool
     */
    public function isEqual(self $currency)
    {
        return $this->code === $currency->code;
    }

    /**
     * @return int
     */
    public function getFractionDigits()
    {
        return $this->fractionDigits;
    }
}

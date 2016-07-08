<?php

namespace KubaWerlos\Money;

use InvalidArgumentException;

class Converter
{
    /** @var Currency */
    private $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param int $subunitAmount
     * @throws InvalidArgumentException
     * @return string
     */
    public function getUnitFromSubunit($subunitAmount)
    {
        if (!is_int($subunitAmount)) {
            throw new InvalidArgumentException();
        }

        return number_format(
            $subunitAmount / pow(10, $this->currency->getFractionDigits()),
            $this->currency->getFractionDigits(),
            '.',
            ''
        );
    }

    /**
     * @param float|int|string $unitAmount
     * @throws InvalidArgumentException
     * @return int
     */
    public function getSubunitFromUnit($unitAmount)
    {
        if (is_int($unitAmount) || is_float($unitAmount)) {
            $unitAmount = (string) $unitAmount;
        }

        if (!is_string($unitAmount)) {
            throw new InvalidArgumentException();
        }

        return $this->getSubunitFromStringUnit($unitAmount);
    }

    /**
     * @param string $unitAmountString
     * @throws InvalidArgumentException
     * @return int
     */
    private function getSubunitFromStringUnit($unitAmountString)
    {
        if (!$this->isValidUnitAmount($unitAmountString)) {
            throw new InvalidArgumentException();
        }

        return (int) round(pow(10, $this->currency->getFractionDigits()) * $unitAmountString);
    }

    /**
     * @param string $unitAmount
     * @return bool
     */
    private function isValidUnitAmount($unitAmount)
    {
        $fractionDigits = $this->currency->getFractionDigits() > 0
            ? sprintf('(\.\d{1,%d})?', $this->currency->getFractionDigits())
            : '';

        return preg_match(sprintf('/(?=^-?\d+%s$)(?!^-?0\d+)/', $fractionDigits), $unitAmount) > 0;
    }
}

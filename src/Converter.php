<?php

namespace KubaWerlos\Money;

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
     * @throws \InvalidArgumentException
     * @return string
     */
    public function getUnitFromSubunit($subunitAmount)
    {
        if (!is_int($subunitAmount)) {
            throw new \InvalidArgumentException();
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
     * @throws \InvalidArgumentException
     * @return int
     */
    public function getSubunitFromUnit($unitAmount)
    {
        if (is_int($unitAmount) || is_float($unitAmount)) {
            $unitAmount = (string) $unitAmount;
        }

        if (!is_string($unitAmount)) {
            throw new \InvalidArgumentException();
        }

        return $this->getSubunitFromUnitString($unitAmount);
    }

    /**
     * @param string $unitAmountString
     * @return int
     */
    private function getSubunitFromUnitString($unitAmountString)
    {
        if (!$this->isValidUnitAmountString($unitAmountString)) {
            throw new \InvalidArgumentException();
        }

        return (int) round(pow(10, $this->currency->getFractionDigits()) * $unitAmountString);
    }

    /**
     * @param string $unitAmount
     * @throws \InvalidArgumentException
     * @return bool
     */
    private function isValidUnitAmountString($unitAmount)
    {
        $pattern = '-?\d+';

        if ($this->currency->getFractionDigits() > 0) {
            $pattern .= sprintf('(\.\d{1,%d})?', $this->currency->getFractionDigits());
        }

        return preg_match('/^' . $pattern . '$/', $unitAmount) > 0 && preg_match('/^0\d+/', $unitAmount) === 0;
    }
}

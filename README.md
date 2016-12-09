# Kuba Werłos / Money

[![Latest Stable Version](https://img.shields.io/packagist/v/kubawerlos/money.svg)](https://packagist.org/packages/kubawerlos/money)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%207-8892BF.svg)](https://php.net)
[![License](https://img.shields.io/github/license/kubawerlos/money.svg)](https://packagist.org/packages/kubawerlos/money)
[![Build Status](https://img.shields.io/travis/kubawerlos/money/master.svg)](https://travis-ci.org/kubawerlos/money)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/kubawerlos/money/master.svg)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)
[![Code Quality](https://img.shields.io/scrutinizer/g/kubawerlos/money/master.svg)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)

Simple PHP implementation of Money Value Object.

## Installation
```bash
    composer require kubawerlos/money
```

## Usage
```php
    use KubaWerlos\Money\Money;

    $fiveEuro = new Money(5, 'EUR');

    $tenEuro = $fiveEuro->add($fiveEuro);

    $fiveEuro->multiply(2)->isEqual($tenEuro);

    $tenEuro->subtract($fiveEuro)->isEqual($fiveEuro);

    $tenEuro->divide(2)->isEqual($fiveEuro);
```

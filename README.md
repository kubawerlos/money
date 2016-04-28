KubaWerlos / Money
==================

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg)](https://php.net/)
[![Travis CI](https://travis-ci.org/kubawerlos/money.svg?branch=master)](https://travis-ci.org/kubawerlos/money)

Simple implementation of Money Value Object

Installation
------------

    composer require kubawerlos/money


Usage
-----

```php
<?php

use KubaWerlos\Money\Currency;
use KubaWerlos\Money\Money;

$tenEuro = new Money(10, new Currency('EUR'));

$twentyEuro = $tenEuro->add($tenEuro);

assert($twentyEuro->isEqual(new Money(20.00, new Currency('EUR'))));
```

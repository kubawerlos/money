KubaWerlos / Money
==================

[![Latest stable version](https://poser.pugx.org/kubawerlos/money/v/stable)](https://packagist.org/packages/kubawerlos/money)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg)](https://php.net)
[![Travis CI build](https://travis-ci.org/kubawerlos/money.svg?branch=master)](https://travis-ci.org/kubawerlos/money)
[![Scrutinizer quality score](https://scrutinizer-ci.com/g/kubawerlos/money/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kubawerlos/money/code-structure/master)
[![Scrutinizer code coverage](https://scrutinizer-ci.com/g/kubawerlos/money/badges/coverage.png?b=master)](https://php.net/)
[![License](https://poser.pugx.org/kubawerlos/money/license)](https://packagist.org/packages/kubawerlos/money)

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

$fiveEuro = new Money(5, new Currency('EUR'));

$tenEuro = $fiveEuro->add($fiveEuro);

$fiveEuro->multiply(2)->isEqual($tenEuro);

$tenEuro->subtract($fiveEuro)->isEqual($fiveEuro);

$tenEuro->divide(2)->isEqual($fiveEuro);
```

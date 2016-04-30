KubaWerlos / Money
==================

[![Latest Stable Version](https://poser.pugx.org/kubawerlos/money/v/stable)](https://packagist.org/packages/kubawerlos/money)
[![Latest Unstable Version](https://poser.pugx.org/kubawerlos/money/v/unstable)](https://packagist.org/packages/kubawerlos/money)
[![License](https://poser.pugx.org/kubawerlos/money/license)](https://packagist.org/packages/kubawerlos/money)
[![Build Status](https://travis-ci.org/kubawerlos/money.svg?branch=master)](https://travis-ci.org/kubawerlos/money)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kubawerlos/money/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kubawerlos/money/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)
[![Code Climate](https://codeclimate.com/github/kubawerlos/money/badges/gpa.svg)](https://codeclimate.com/github/kubawerlos/money)
[![Issue Count](https://codeclimate.com/github/kubawerlos/money/badges/issue_count.svg)](https://codeclimate.com/github/kubawerlos/money/issues)

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

KubaWerlos / Money
==================

[![Latest Stable Version](https://poser.pugx.org/kubawerlos/money/v/stable)](https://packagist.org/packages/kubawerlos/money)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207-8892BF.svg)](https://php.net)
[![License](https://poser.pugx.org/kubawerlos/money/license)](https://packagist.org/packages/kubawerlos/money)
[![Build Status](https://travis-ci.org/kubawerlos/money.svg?branch=master)](https://travis-ci.org/kubawerlos/money)
[![Code Coverage](https://scrutinizer-ci.com/g/kubawerlos/money/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kubawerlos/money/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kubawerlos/money/?branch=master)
[![Code Climate](https://codeclimate.com/github/kubawerlos/money/badges/gpa.svg)](https://codeclimate.com/github/kubawerlos/money)

Simple implementation of Money Value Object

Installation
------------

    composer require kubawerlos/money


Usage
-----

```php
<?php

use KubaWerlos\Money\Money;

$fiveEuro = new Money(5, 'EUR');

$tenEuro = $fiveEuro->add($fiveEuro);

$fiveEuro->multiply(2)->isEqual($tenEuro);

$tenEuro->subtract($fiveEuro)->isEqual($fiveEuro);

$tenEuro->divide(2)->isEqual($fiveEuro);
```

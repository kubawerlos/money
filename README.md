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

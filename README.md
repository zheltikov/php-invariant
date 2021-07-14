# php-invariant

Yet another assertion library.

## Installation

You can install this library via composer:

```shell
$ composer require zheltikov/php-invariant
```

## Usage

The main function to be used in this library is `invariant`. This function is intended to indicate a programmer error
for a condition that should never occur, similar
to [assertions](https://en.wikipedia.org/wiki/Assertion_(software_development)). For example:

```php
<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use function Zheltikov\Invariant\invariant;

$obj = new DateTime();
invariant($obj instanceof DateTime, 'Object must have type DateTime');

$p = 123;
invariant($p !== null, 'Value can\'t be null');

$max = 100;
invariant($p !== null && $p <= $max, '$p\'s value %d must be <= %d', $p, $max);

```

If the first argument value evaluates to true, the program continues execution; otherwise, the
function `invariant_violation` is called. That function either throws an `InvariantException`, or calls the handler
previously registered by the function `invariant_callback_register`.

The first argument is evaluated as a boolean expression. The second argument is a string that can contain text and/or
optional formatting information as understood by the function [`sprintf`](https://www.php.net/sprintf). The optional
comma-separated list of values following the string must match the set of types expected by the optional formatting
information inside that string.

## TODO

- [X] Build a functional-style assertion library
- [ ] Build an object-oriented interface for these functions

--TEST--
Test that invariant checks work as expected.
--FILE--
<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use function Zheltikov\Invariant\invariant;

function format(Throwable $e): void
{
    echo get_class($e) . ': ' . $e->getMessage() . "\n";
}

try {
    invariant(true, 'Simple message for true.');
} catch (Throwable $e) {
    format($e);
}

try {
    invariant(false, 'Simple message for false.');
} catch (Throwable $e) {
    format($e);
}

try {
    invariant(true, 'Formatted message: %s, %d', 'hello', 123);
} catch (Throwable $e) {
    format($e);
}

try {
    invariant(2 > 10, 'Another Formatted message: %d -> %d', 123, 321);
} catch (Throwable $e) {
    format($e);
}

?>
--EXPECT--
Zheltikov\Exceptions\InvariantException: Simple message for false.
Zheltikov\Exceptions\InvariantException: Another Formatted message: 123 -> 321
--TEST--
Test that invariant_violation throws an exception.
--FILE--
<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use function Zheltikov\Invariant\invariant_violation;

function format(Throwable $e): void
{
    echo get_class($e) . ': ' . $e->getMessage() . "\n";
}

try {
    invariant_violation('Simple message without formatting');
} catch (Throwable $e) {
    format($e);
}

try {
    invariant_violation('This call has one string argument: %s', 'hello world');
} catch (Throwable $e) {
    format($e);
}

try {
    invariant_violation('This call has several args: %%s: %s, %%d: %d', 'hello world', 123);
} catch (Throwable $e) {
    format($e);
}

try {
    invariant_violation('This call has several positional args: 2d = %2$d ; 1s = %1$s', 'one more', 321);
} catch (Throwable $e) {
    format($e);
}

?>
--EXPECT--
Zheltikov\Exceptions\InvariantException: Simple message without formatting
Zheltikov\Exceptions\InvariantException: This call has one string argument: hello world
Zheltikov\Exceptions\InvariantException: This call has several args: %s: hello world, %d: 123
Zheltikov\Exceptions\InvariantException: This call has several positional args: 2d = 321 ; 1s = one more
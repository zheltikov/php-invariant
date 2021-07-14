--TEST--
Test that invariant checks work as expected.
--FILE--
<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use function Zheltikov\Invariant\{invariant, invariant_callback_register};

function format(Throwable $e): void
{
    echo get_class($e) . ': ' . $e->getMessage() . "\n";
}

try {
    invariant_callback_register(
        function () {
            echo "\n**********\n";
            echo json_encode(func_get_args());
            echo "\n**********\n";
        }
    );
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

try {
    invariant_callback_register(
        function () {
            echo "I should not work...\n";
        }
    );
} catch (Throwable $e) {
    format($e);
}

try {
    invariant(false && false, 'Error!');
} catch (Throwable $e) {
    format($e);
}

?>
--EXPECT--

**********
["Simple message for false."]
**********
Zheltikov\Exceptions\InvariantException: Simple message for false.

**********
["Another Formatted message: %d -> %d",123,321]
**********
Zheltikov\Exceptions\InvariantException: Another Formatted message: 123 -> 321

**********
["Callback already registered: %s",{}]
**********
Zheltikov\Exceptions\InvariantException: Callback already registered: Object of type Closure

**********
["Error!"]
**********
Zheltikov\Exceptions\InvariantException: Error!

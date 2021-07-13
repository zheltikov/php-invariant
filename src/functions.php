<?php

namespace Zheltikov\Invariant;

use Zheltikov\Exceptions\InvariantException;

/**
 * When objects are passed as an argument, without a __toString() defined,
 * causes a fatal error. Handle these objects gracefully by displaying their
 * class name.
 *
 * @param mixed $arg
 * @return mixed|string
 */
function invariant_violation_helper($arg)
{
    if (!is_object($arg) || method_exists($arg, '__toString')) {
        return $arg;
    }

    return 'Object of type ' . get_class($arg);
}

/**
 * Pass a callable that will be called when any `invariant` fails. The callback
 * will be called with all the `invariant` parameters after the condition.
 *
 * @param callable $callback The function that will be called when an invariant
 *                           fails.
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function invariant_callback_register(callable $callback): void
{
    invariant(
        is_callable($callback),
        'Callback not callable: %s',
        $callback,
    );

    invariant(
        InvariantCallback::get() === null,
        'Callback already registered: %s',
        InvariantCallback::get(),
    );

    InvariantCallback::set($callback);
}

/**
 * Ensure that an invariant is satisfied. If it fails, it calls
 * `invariant_violation`
 *
 * @param mixed $test
 * @param string $format_str The string that will be displayed when your
 *                           invariant fails, with possible placeholders.
 * @param mixed ...$args
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function invariant($test, string $format_str, ...$args): void
{
    if (!$test) {
        invariant_violation($format_str, ...$args);
    }
}

/**
 * Call this when one of your `invariant`s has been violated. It calls the
 * function you registered with `invariant_callback_register` and then throws an
 * `InvariantException`
 *
 * @param string $format_str The string that will be displayed when your
 *                           invariant fails.
 * @param mixed ...$args
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function invariant_violation(string $format_str, ...$args): void
{
    $callback = InvariantCallback::get();
    if ($callback !== null) {
        $callback($format_str, ...$args);
    }

    foreach ($args as $i => $arg) {
        if (is_object($arg)) {
            $args[$i] = invariant_violation_helper($arg);
        }
    }
    $message = vsprintf($format_str, $args);

    throw new InvariantException($message);
}

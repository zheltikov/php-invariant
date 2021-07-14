<?php

/**
 * @deprecated Use package `zheltikov/php-type-assert` instead.
 */

namespace Zheltikov\Invariant\TypeAssert;

use function Zheltikov\TypeAssert\{
    is_ as __is_,
    as_ as __as_,
    null_as_ as __null_as_,
};

/**
 * Checks whether a value has the type specified, and returns a boolean result.
 *
 * @param mixed $value
 * @param string $type
 * @return bool
 * @throws \Zheltikov\Exceptions\InvariantException
 * @deprecated Use `is_()` from `zheltikov/php-type-assert` instead.
 */
function is_($value, string $type): bool
{
    return __is_($value, $type);
}

/**
 * Performs the same checks as `is_`.
 * However, it throws `TypeAssertionException` if the value has a different
 * type.
 *
 * @param mixed $value
 * @param string $expected
 * @return mixed
 * @throws \Zheltikov\Exceptions\TypeAssertionException
 * @throws \Zheltikov\Exceptions\InvariantException
 * @deprecated Use `as_()` from `zheltikov/php-type-assert` instead.
 */
function as_($value, string $expected)
{
    return __as_($value, $expected);
}

/**
 * Similar to `as_`, but which returns null if the type does not match.
 *
 * @param mixed $value
 * @param string $expected
 * @return mixed|null
 * @throws \Zheltikov\Exceptions\InvariantException
 * @deprecated Use `null_as_()` from `zheltikov/php-type-assert` instead.
 */
function null_as_($value, string $expected)
{
    return __null_as_($value, $expected);
}

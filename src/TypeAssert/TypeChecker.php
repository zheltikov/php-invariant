<?php

namespace Zheltikov\Invariant\TypeAssert;

use Zheltikov\TypeAssert\TypeChecker as __TypeChecker;

/**
 * Class TypeChecker
 * @package Zheltikov\Invariant\TypeAssert
 * @deprecated Use `TypeChecker` from `zheltikov/php-type-assert` instead.
 */
final class TypeChecker
{
    private function __construct()
    {
    }

    /**
     * @param string $type
     * @return callable
     * @throws \Zheltikov\Exceptions\InvariantException
     * @deprecated Use `TypeChecker::getCheckerFn` from `zheltikov/php-type-assert` instead.
     */
    public static function getCheckerFn(string $type): callable
    {
        return __TypeChecker::getCheckerFn($type);
    }
}

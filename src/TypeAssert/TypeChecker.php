<?php

namespace Zheltikov\Invariant\TypeAssert;

use function Zheltikov\Invariant\{invariant, invariant_violation};

/**
 * Class TypeChecker
 * @package Zheltikov\Invariant\TypeAssert
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
     */
    public static function getCheckerFn(string $type): callable
    {
        invariant(strlen($type), 'Type string must not be empty.');

        // null
        // nonnull
        // enums
        // tuples
        // num

        // bool
        // int
        // float
        // num = int|float
        // string
        // void
        // tuples
        // shapes (by default, closed)
        // open shapes (with ... in the field list)
        // optional shape fields (like `shape(?'my_field' => int)`)
        // arraykey = int|string
        // Enums
        // Backed Enums
        // this
        // classname, classname<_>
        // varray<_>, vec<_>
        // darray<_, _>, dict<_, _>
        // array<_>, array<_, _>
        // resource
        // null
        // nullable type: ?string
        // nonnull
        // mixed = dynamic
        // noreturn
        // nothing = void

        // vec, keyset, dict
        // Vector, ImmVector, Map, ImmMap, Set, ImmSet and Pair
        // Container interfaces
        // varray, darray, varray_or_darray and array

        invariant_violation('Unknown type string %s provided.', $type);
    }
}

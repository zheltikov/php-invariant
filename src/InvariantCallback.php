<?php

namespace Zheltikov\Invariant;

/**
 * Class InvariantCallback
 * @package Zheltikov\Invariant
 */
final class InvariantCallback
{
    /**
     * @var callable|null
     */
    public static $callback = null;

    private function __construct()
    {
    }

    public static function get(): ?callable
    {
        return self::$callback;
    }

    public static function set(?callable $callback): void
    {
        self::$callback = $callback;
    }
}

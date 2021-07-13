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

    /**
     * @return callable|null
     */
    public static function get(): ?callable
    {
        return self::$callback;
    }

    /**
     * @param callable|null $callback
     */
    public static function set(?callable $callback): void
    {
        self::$callback = $callback;
    }
}

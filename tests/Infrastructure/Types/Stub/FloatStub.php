<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class FloatStub
{
    private const PHP_FLOAT_MAX = 1.7976931348623e+308;

    public static function random(): float
    {
        return self::between(0);
    }

    public static function randomPositive(): float
    {
        return self::between(1);
    }

    public static function between(float $min, float $max = self::PHP_FLOAT_MAX): float
    {
        return PrimitiveTypesStub::random()->numberBetween($min, $max);
    }

    public static function lessThan(float $max): float
    {
        return self::between(1, $max);
    }

    public static function moreThan(float $min): float
    {
        return self::between($min);
    }
}

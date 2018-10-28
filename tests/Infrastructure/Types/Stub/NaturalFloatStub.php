<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class NaturalFloatStub
{
    public static function random(): float
    {
        return self::between(0);
    }

    public static function randomPositive(): float
    {
        return self::between(1);
    }

    public static function between(float $min, ?float $max = null, ?int $decimals = 2): float
    {
        return PrimitiveTypesStub::random()->randomFloat($decimals, $min, $max);
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

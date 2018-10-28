<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class NaturalIntStub
{
    public static function random(): int
    {
        return self::between(0);
    }

    public static function randomPositive(): int
    {
        return self::between(1);
    }

    public static function between(int $min, int $max = PHP_INT_MAX): int
    {
        return PrimitiveTypesStub::random()->numberBetween($min, $max);
    }

    public static function lessThan(int $max): int
    {
        return self::between(1, $max);
    }

    public static function moreThan(int $min): int
    {
        return self::between($min);
    }
}

<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class TinyIntStub
{
    const MAX_INT = 127;
    public static function random(): int
    {
        return self::between(1);
    }

    public static function between(int $min, int $max = self::MAX_INT): int
    {
        return PrimitiveTypesStub::random()->numberBetween($min, $max);
    }

    public static function moreThan(int $min): int
    {
        return self::between($min, self::MAX_INT);
    }
}

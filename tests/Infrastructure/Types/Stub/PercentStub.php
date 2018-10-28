<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class PercentStub
{
    const DEFAULT_DECIMALS = 2;

    public static function random(?int $decimals = self::DEFAULT_DECIMALS): float
    {
        return self::greaterThan((float) 0, $decimals);
    }

    public static function greaterThan(?float $value, ?int $decimals = self::DEFAULT_DECIMALS): float
    {
        return self::between($value, (float) 100, $decimals);
    }

    public static function lowerThan(float $value, ?int $decimals = self::DEFAULT_DECIMALS): float
    {
        return self::between((float) 0, $value, $decimals);
    }

    public static function between(?float $min = 0, ?float $max = 100, ?int $decimals = self::DEFAULT_DECIMALS): float
    {
        return PrimitiveTypesStub::random()->randomFloat($decimals, $min, $max);
    }
}

<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class BooleanStub
{
    public static function random(): bool
    {
        return PrimitiveTypesStub::random()->boolean(50);
    }

    public static function true(): bool
    {
        return PrimitiveTypesStub::random()->boolean(100);
    }

    public static function false(): bool
    {
        return PrimitiveTypesStub::random()->boolean(0);
    }
}

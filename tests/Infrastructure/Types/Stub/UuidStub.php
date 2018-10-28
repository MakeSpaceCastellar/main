<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class UuidStub
{
    public static function random(): string
    {
        return PrimitiveTypesStub::random()->unique()->uuid;
    }
}

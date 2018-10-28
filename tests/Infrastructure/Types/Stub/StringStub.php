<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class StringStub
{
    private const MIN_RANDOM_CHARS = 5;
    private const MAX_RANDOM_CHARS = 200;

    public static function random(): string
    {
        return self::withMaxChars(NaturalIntStub::between(self::MIN_RANDOM_CHARS, self::MAX_RANDOM_CHARS));
    }

    public static function withMaxChars(int $maxChars): string
    {
        return PrimitiveTypesStub::random()->text($maxChars);
    }
}

<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

use Faker\Factory;

final class PrimitiveTypesStub
{
    private static $faker;

    private const FIXTURES_LANGUAGE = 'es_ES';

    public static function random()
    {
        return self::faker();
    }

    private static function faker()
    {
        return self::$faker = self::$faker ?: Factory::create(self::FIXTURES_LANGUAGE);
    }
}

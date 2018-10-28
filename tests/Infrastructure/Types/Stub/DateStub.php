<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class DateStub
{
    public static function random(): string
    {
        return date('Y-m-d H:i:s', rand());
    }

    public static function past(): string
    {
        return date('Y-m-d H:i:s', rand(0, time()));
    }

    public static function future(): string
    {
        return date('Y-m-d H:i:s', rand(time(), getrandmax()));
    }
}

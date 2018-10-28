<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

trait RandomSeededStringTrait
{
    public static function randomSeededString(string $seed, int $minLength, int $maxLength): string
    {
        return substr(str_shuffle(str_repeat($seed, mt_rand(10, 20))), 1, mt_rand($minLength, $maxLength));
    }
}

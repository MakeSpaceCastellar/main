<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

class NaturalIntValueObject extends IntValueObject
{
    private const MINIMUM_INT = 0;

    public function __construct(int $value)
    {
        parent::__construct($value);

        self::guard($value);
    }

    private static function guard($value)
    {
        if (!self::isValid($value)) {
            throw new InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the value "%s", with type <%s>.',
                    static::class,
                    is_scalar($value) ? $value : gettype($value),
                    gettype($value)
                )
            );
        }
    }

    private static function isValid($value)
    {
        return $value >= self::MINIMUM_INT;
    }
}

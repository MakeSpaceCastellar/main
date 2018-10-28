<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

abstract class PercentValueObject extends FloatValueObject
{
    private const MIN_VALUE = 0;
    private const MAX_VALUE = 100;

    public function __construct(float $value)
    {
        parent::__construct($value);
        self::guard($value);
    }

    private static function guard(float $value): void
    {
        if (self::MAX_VALUE < $value || self::MIN_VALUE > $value) {
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
}

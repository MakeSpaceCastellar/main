<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

abstract class NaturalFloatValueObject extends FloatValueObject
{
    private const MINIMUM_INT = 0;

    public function __construct(float $value)
    {
        parent::__construct($value);

        $this->guard($value);
    }

    private function guard($value)
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

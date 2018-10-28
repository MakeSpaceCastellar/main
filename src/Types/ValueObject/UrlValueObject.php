<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

abstract class UrlValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    private function guard(string $value)
    {
        if (false === filter_var($value, \FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the url <%s>.', static::class, $value)
            );
        }
    }
}

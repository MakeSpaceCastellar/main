<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

abstract class DateTimeValueObject extends StringValueObject
{
    public function __construct(string $value, ?string $format = DateTime::ATOM)
    {
        parent::__construct($this->guard($value, $format));
    }

    private function guard(string $value, string $format): string
    {
        $date = DateTimeImmutable::createFromFormat($format, $value);

        if (false === $date) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the date format <%s>.', static::class, $value)
            );
        }

        return $date->format($format);
    }
}

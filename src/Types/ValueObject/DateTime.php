<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use DateTimeImmutable;

final class DateTime
{
    private $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    /**
     * Accepts an string in ISO 8601 format such as 2017-12-31T23:59:59+02:00 and returns an instance of this class.
     *
     * @link https://en.wikipedia.org/wiki/ISO_8601
     */
    public static function fromIso8601(string $iso8601): DateTime
    {

        return new static(DateTimeImmutable::createFromFormat(\DateTime::ATOM, $iso8601));
    }

    /**
     * Returns an string in ISO 8601 format such as 2017-12-31T23:59:59+02:00 and returns an instance of this class.
     *
     * @link https://en.wikipedia.org/wiki/ISO_8601
     */
    public function toIso8601(): string
    {
        return $this->value->format(\DateTime::ATOM);
    }

    public function value(): string
    {
        return $this->toIso8601();
    }

    public function __toString(): string
    {
        return $this->toIso8601();
    }
}

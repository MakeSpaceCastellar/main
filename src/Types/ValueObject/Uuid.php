<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private $value;

    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public static function fromBytes(string $bytes)
    {
        try {
            return new static(RamseyUuid::fromBytes($bytes)->toString());
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the bytes <%s>.',
                    static::class,
                    $bytes
                )
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    private function guard($value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw new InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the value <%s>.',
                    static::class,
                    is_scalar($value) ? $value : gettype($value)
                )
            );
        }
    }

    public function __toString()
    {
        return $this->value();
    }

    public function getBytes(): string
    {
        return RamseyUuid::fromString($this->value())->getBytes();
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }
}

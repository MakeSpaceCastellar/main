<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

class ArrayValueObject
{
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function value(): array
    {
        return $this->value;
    }
}

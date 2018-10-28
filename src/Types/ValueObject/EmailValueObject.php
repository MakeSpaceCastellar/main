<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

class EmailValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    private function guard(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The value <%s> is not a valid email',
                    $value
                )
            );
        }
    }
}

<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

class IpAddress extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    private function guard(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The value <%s> is not a valid v4 ip address',
                    $value
                )
            );
        }
    }
}

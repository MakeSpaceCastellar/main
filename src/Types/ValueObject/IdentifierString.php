<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use InvalidArgumentException;

class IdentifierString extends StringValueObject
{
    public function __construct($id)
    {
        $this->guard($id);

        parent::__construct($id);
    }

    public function guard($id)
    {
        if (!$this->isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the identifier <%s>.', static::class, is_scalar($id) ? $id : gettype($id))
            );
        }
    }

    private function isValid($id)
    {
        return is_string($id);
    }
}

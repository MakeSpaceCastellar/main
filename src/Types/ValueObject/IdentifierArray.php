<?php

declare(strict_types=1);

namespace MakeSpace\Types\ValueObject;

use ArrayObject;
use InvalidArgumentException;

class IdentifierArray extends ArrayObject
{
    public function __construct($id)
    {
        $this->guard($id);

        parent::__construct($id);
    }

    private function guard($id)
    {
        if (!$this->isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the identifier <%s>. Must be an <array>', static::class, gettype($id))
            );
        }
    }

    private function isValid($id)
    {
        return is_array($id);
    }
}

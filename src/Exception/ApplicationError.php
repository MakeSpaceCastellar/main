<?php

declare(strict_types=1);

namespace MakeSpace\Exception;

use DomainException;

abstract class ApplicationError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract public function errorCode(): string;

    abstract protected function errorMessage(): string;
}

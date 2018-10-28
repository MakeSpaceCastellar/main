<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UuidGenerator
{
    public function next(): UuidInterface
    {
        return Uuid::uuid4();
    }
}

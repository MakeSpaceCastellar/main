<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use RuntimeException;

final class TransactionalServiceByTagNotDefined extends RuntimeException
{
    public function __construct($service)
    {
        parent::__construct(sprintf('The "by" tag is not defined inside the <%s> transactional definition', $service));
    }
}

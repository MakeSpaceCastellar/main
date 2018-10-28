<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Bus\Domain\Query;

use RuntimeException;

interface QueryBus
{
    /**
     * @throws RuntimeException
     *
     * @return void
     */
    public function register(string $queryClass, callable $handler): void;

    /**
     * @throws RuntimeException
     *
     * @return Response|null
     */
    public function ask(Query $query);
}

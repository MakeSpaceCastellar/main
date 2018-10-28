<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Bus\Query;

use MakeSpace\Infrastructure\Bus\HandleLocator;
use MakeSpace\Shared\Module\Bus\Domain\Query\Query;
use MakeSpace\Shared\Module\Bus\Domain\Query\QueryBus;
use RuntimeException;

class QueryBusSync implements QueryBus
{
    private $locator;
    private $askHasBeenCalled = false;

    public function __construct()
    {
        $this->locator = new HandleLocator();
    }

    public function register(string $queryClass, callable $handler): void
    {
        $this->guardAskHasNotBeenCalled();

        $this->locator->add($queryClass, $handler);
    }

    public function ask(Query $query)
    {
        $this->markAsAsked();

        $handler = $this->locator->find(get_class($query));


        return $handler($query);
    }

    private function guardAskHasNotBeenCalled(): void
    {
        if ($this->askHasBeenCalled) {
            throw new RuntimeException('Trying to register a new handler after some query has been asked');
        }
    }

    private function markAsAsked(): void
    {
        if (!$this->askHasBeenCalled) {
            $this->askHasBeenCalled = true;
        }
    }
}

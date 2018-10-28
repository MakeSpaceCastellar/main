<?php

declare(strict_types=1);

namespace MakeSpace\Types\Aggregate;

use MakeSpace\Shared\Module\Bus\Domain\Event\DomainEvent;
use MakeSpace\Types\Collection;
use function Lambdish\phunctional\reduce;

abstract class AggregateRootCollection extends Collection
{
    /** @return DomainEvent[] */
    public function pullDomainEvents()
    {
        return reduce($this->pullItemDomainEvents(), $this, []);
    }

    private function pullItemDomainEvents()
    {
        return function (array $accumulatedEvents, AggregateRoot $aggregateRoot) {
            return array_merge($accumulatedEvents, $aggregateRoot->pullDomainEvents());
        };
    }
}

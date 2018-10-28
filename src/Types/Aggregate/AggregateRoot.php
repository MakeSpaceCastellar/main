<?php

declare(strict_types=1);

namespace MakeSpace\Types\Aggregate;

use MakeSpace\Shared\Module\Bus\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    private $domainEvents = [];

    final public function pullDomainEvents()
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function raise(DomainEvent $domainEvent)
    {
        $this->domainEvents[] = $domainEvent;
    }
}

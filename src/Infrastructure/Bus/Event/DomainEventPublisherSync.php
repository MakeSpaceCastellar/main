<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Bus\Event;

use MakeSpace\Shared\Module\Bus\Domain\Event\DomainEvent;
use MakeSpace\Shared\Module\Bus\Domain\Event\DomainEventPublisher;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use RuntimeException;
use function Lambdish\Phunctional\each;

final class DomainEventPublisherSync implements DomainEventPublisher
{
    private $bus;
    private $router;
    private $routerIsAttached;
    private $events;

    public function __construct()
    {
        $this->bus              = new EventBus();
        $this->router           = new EventRouter();
        $this->routerIsAttached = false;
        $this->events           = [];
    }

    public function subscribe(string $eventClass, callable $subscriber): void
    {
        $this->guardRouterIsAttached();

        $this->router->route($eventClass)->to($subscriber);
    }

    public function record(DomainEvent ...$domainEvents): void
    {
        $this->events = array_merge($this->events, array_values($domainEvents));
    }

    public function publishRecorded(): void
    {
        $this->attachRouter();

        each($this->eventPublisher(), $this->popEvents());
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        $this->record(...$domainEvents);
        $this->publishRecorded();
    }

    private function guardRouterIsAttached(): void
    {
        if ($this->routerIsAttached) {
            throw new RuntimeException('Trying to register a new subscriber after some publish has been done');
        }
    }

    private function attachRouter(): void
    {
        if (!$this->routerIsAttached) {
            $this->router->attachToMessageBus($this->bus);

            $this->routerIsAttached = true;
        }
    }

    private function eventPublisher()
    {
        return function (DomainEvent $event) {
            $this->bus->dispatch($event);
        };
    }

    private function popEvents()
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
    }
}

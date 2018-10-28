<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Bus\Command;

use MakeSpace\Shared\Module\Bus\Domain\Command\Command;
use MakeSpace\Shared\Module\Bus\Domain\Command\CommandBus;
use Prooph\ServiceBus\CommandBus as ProophCommandBus;
use Prooph\ServiceBus\Plugin\Router\CommandRouter;
use RuntimeException;

class CommandBusSync implements CommandBus
{
    private $bus;
    private $router;
    private $routerIsAttached;

    public function __construct()
    {
        $this->bus              = new ProophCommandBus();
        $this->router           = new CommandRouter();
        $this->routerIsAttached = false;
    }

    public function register(string $commandClass, callable $handler): void
    {
        $this->guardRouterIsAttached();

        $this->router->route($commandClass)->to($handler);
    }

    public function dispatch(Command $command): void
    {
        $this->attachRouter();

        $this->bus->dispatch($command);
    }

    private function guardRouterIsAttached()
    {
        if ($this->routerIsAttached) {
            throw new RuntimeException('Trying to register a new handler after some dispatch has been done');
        }
    }

    private function attachRouter()
    {
        if (!$this->routerIsAttached) {
            $this->router->attachToMessageBus($this->bus);

            $this->routerIsAttached = true;
        }
    }
}

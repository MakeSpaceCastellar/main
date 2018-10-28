<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Bus\Domain\Command;

interface CommandBus
{
    public function register(string $commandClass, callable $handler): void;

    public function dispatch(Command $command): void;
}

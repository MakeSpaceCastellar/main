<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Unit;

use MakeSpace\Shared\Module\Bus\Domain\Command\Command;
use MakeSpace\Shared\Module\Bus\Domain\Query\Query;
use MakeSpace\Shared\Module\Bus\Domain\Query\Response;

abstract class UnitTestCaseWithBus extends UnitTestCase
{
    protected function assertQueryHandlerResponse(callable $handler, Query $query, Response $response): void
    {
        self::assertEquals(
            $response,
            $this->handleQuery($handler, $query),
            'The query handler didn\'t return the expected response'
        );
    }

    protected function handleQuery(callable $handler, Query $query): Response
    {
        return $handler($query);
    }

    protected function assertCommandHandlerResponse(callable $handler, Command $command): void
    {
        $this->handleCommand($handler, $command);
        $this->assertTrue(true);
    }

    protected function handleCommand(callable $handler, Command $query): void
    {
        $handler($query);
    }
}

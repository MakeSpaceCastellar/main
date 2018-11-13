<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Controller;

use MakeSpace\Landing\Module\Role\Domain\Model\Role;
use MakeSpace\Infrastructure\Bus\Command\CommandBusSync;
use MakeSpace\Infrastructure\Bus\Query\CachedQueryBusSync;
use MakeSpace\Infrastructure\Bus\Query\QueryBusSync;
use MakeSpace\Shared\Module\Bus\Domain\Command\Command;
use MakeSpace\Shared\Module\Bus\Domain\Query\Query;
use MakeSpace\Shared\Module\Bus\Domain\Query\Response as QueryResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class WebController extends AbstractController
{
    private $queryBusSync;
    private $cachedQueryBusSync;
    private $commandBusSync;

    public function __construct(
        QueryBusSync $queryBusSync,
        CachedQueryBusSync $cachedQueryBusSync,
        CommandBusSync $commandBusSync
    ) {
        $this->queryBusSync       = $queryBusSync;
        $this->cachedQueryBusSync = $cachedQueryBusSync;
        $this->commandBusSync     = $commandBusSync;
    }

    abstract protected function doInvoke(Request $request);

    public function __invoke(Request $request)
    {
        return $this->doInvoke($request);
    }

    protected function ask(Query $query)
    {
        return $this->queryBusSync->ask($query);
    }

    protected function rawCachedAsk(Query $query): ?QueryResponse
    {
        return $this->cachedQueryBusSync->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBusSync->dispatch($command);
    }
}

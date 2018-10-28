<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Bus\Query;

use MakeSpace\Shared\Module\Bus\Domain\Query\Query;
use MakeSpace\Shared\Module\Bus\Domain\Query\QueryBus;
use MakeSpace\Shared\Module\Cache\Domain\QueryCacheKey;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class CachedQueryBusSync implements QueryBus
{
    private $cacheAdapter;
    private $queryBusSync;

    public function __construct(AdapterInterface $cacheAdapter, QueryBusSync $queryBusSync)
    {
        $this->cacheAdapter = $cacheAdapter;
        $this->queryBusSync = $queryBusSync;
    }

    public function ask(Query $query)
    {
        $cachedItem = $this->cacheAdapter->getItem($this->queryCacheKey($query));
        if ($cachedItem->isHit()) {
            $response = $cachedItem->get();
        } else {
            $response = $this->queryBusSync->ask($query);
            $cachedItem->set($response);
            $this->cacheAdapter->save($cachedItem);
        }

        return $response;
    }

    public function register(string $queryClass, callable $handler): void
    {
        $this->queryBusSync->register($queryClass, $handler);
    }

    private function queryCacheKey(Query $query): string
    {
        return QueryCacheKey::fromQuery($query)->value();
    }
}

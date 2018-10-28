<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use Memcached;

abstract class CachedRepository extends Repository implements CachedRepositoryInterface
{
    private $memcachedClient;

    public function __construct(EntityManager $entityManager, Memcached $memcachedClient)
    {
        parent::__construct($entityManager);
        $this->memcachedClient = $memcachedClient;
    }

    public function set(string $key, $value, ?int $expiration = null): bool
    {
        return $this->memcachedClient->set($key, $value, (is_null($expiration) ? 0 : $expiration));
    }

    public function get(string $key)
    {
        $result = $this->memcachedClient->get($key);
        if ($result === false) {
            if ($this->memcachedClient->getResultCode() === Memcached::RES_NOTFOUND) {
                return null;
            } else {
                throw new \Exception($this->memcachedClient->getResultMessage());
            }
        }

        return $result;
    }

    public function delete(string $key): bool
    {
        return $this->memcachedClient->delete($key);
    }
}

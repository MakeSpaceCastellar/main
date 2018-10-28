<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Doctrine;

interface CachedRepositoryInterface extends RepositoryInterface
{
    public function set(string $key, $value, ?int $expiration = null): bool;

    public function get(string $key);

    public function delete(string $key): bool;
}

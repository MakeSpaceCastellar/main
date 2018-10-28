<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;

interface RepositoryInterface
{
    public function entityManager(): EntityManager;
}

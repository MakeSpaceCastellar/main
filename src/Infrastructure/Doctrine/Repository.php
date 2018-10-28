<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;

abstract class Repository implements RepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function entityManager(): EntityManager
    {
        return $this->entityManager;
    }
}

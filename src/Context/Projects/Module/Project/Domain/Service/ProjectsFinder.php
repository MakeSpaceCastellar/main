<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Domain\Service;

use MakeSpace\Context\Projects\Module\Project\Domain\Model\Projects;
use MakeSpace\Context\Projects\Module\Project\Domain\ProjectRepository;

final class ProjectsFinder
{
    private $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?Projects
    {
        return $this->repository->findAll();
    }
}

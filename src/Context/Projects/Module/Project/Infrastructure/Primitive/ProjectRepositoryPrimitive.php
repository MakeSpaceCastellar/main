<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Infrastructure\Primitive;

use MakeSpace\Context\Projects\Module\Project\Domain\Model\Project;
use MakeSpace\Context\Projects\Module\Project\Domain\Model\ProjectName;
use MakeSpace\Context\Projects\Module\Project\Domain\Model\Projects;
use MakeSpace\Context\Projects\Module\Project\Domain\ProjectRepository;

final class ProjectRepositoryPrimitive implements ProjectRepository
{
    public function findAll(): ?Projects
    {
        $projects = new Projects([new Project(new ProjectName('cqrs')), new Project(new ProjectName('arduino'))]);

        return $projects;
    }
}

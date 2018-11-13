<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Application\Find\FindProjects;

use MakeSpace\Context\Projects\Module\Project\Domain\Model\Projects;
use MakeSpace\Context\Projects\Module\Project\Domain\Service\ProjectsFinder;

final class FindProjectsUseCase
{
    private $finder;

    public function __construct(ProjectsFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(): ?Projects
    {
        return $this->finder->__invoke();
    }
}

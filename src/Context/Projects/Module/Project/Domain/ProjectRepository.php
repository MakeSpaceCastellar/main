<?php

namespace MakeSpace\Context\Projects\Module\Project\Domain;

use MakeSpace\Context\Projects\Module\Project\Domain\Model\Projects;

interface ProjectRepository
{
    public function findAll(): ?Projects;

}

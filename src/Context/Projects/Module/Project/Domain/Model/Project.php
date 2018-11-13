<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Domain\Model;

final class Project
{
    private $projectName;

    public function __construct(ProjectName $projectName)
    {
        $this->projectName = $projectName;
    }

    public function projectName(): ProjectName
    {
        return $this->projectName;
    }

}

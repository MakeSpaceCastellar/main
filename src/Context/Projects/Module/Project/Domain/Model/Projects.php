<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Domain\Model;

use MakeSpace\Types\Collection;

final class Projects extends Collection
{
    protected function type(): string
    {
        return Project::class;
    }
}

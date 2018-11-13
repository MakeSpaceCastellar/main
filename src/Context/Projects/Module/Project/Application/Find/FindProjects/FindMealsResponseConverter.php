<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Application\Find\FindProjects;

use MakeSpace\Context\Projects\Module\Project\Domain\Model\Project;
use MakeSpace\Context\Projects\Module\Project\Domain\Model\Projects;
use MakeSpace\Shared\Application\Response\ArrayResponse;
use MakeSpace\Shared\Module\Bus\Domain\Query\Response;
use function Lambdish\Phunctional\map;

final class FindMealsResponseConverter
{
    public function __invoke(?Projects $projects): Response
    {
        $items = $projects ?? [];

        return new ArrayResponse(
            map(
                function (Project $project): array {
                    return [
                        'name' => $project->projectName()->value()
                    ];
                },
                $items
            )
        );
    }
}

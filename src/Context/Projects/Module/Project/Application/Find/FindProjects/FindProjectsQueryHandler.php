<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Module\Project\Application\Find\FindProjects;

use MakeSpace\Shared\Module\Bus\Domain\Query\Response;

final class FindProjectsQueryHandler
{
    private $useCase;

    public function __construct(FindProjectsUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(FindProjectsQuery $query): Response
    {
        $projects = $this->useCase->__invoke();

        $responseConverter = new FindMealsResponseConverter();

        return $responseConverter->__invoke($projects);
    }
}

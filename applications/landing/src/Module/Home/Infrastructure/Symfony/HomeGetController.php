<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Module\Home\Infrastructure\Symfony;

use MakeSpace\Context\Projects\Module\Project\Application\Find\FindProjects\FindProjectsQuery;
use MakeSpace\Landing\Infrastructure\Controller\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomeGetController extends WebController
{
    protected function doInvoke(Request $request): Response
    {
        $projects = $this->ask(new FindProjectsQuery());
        dump($projects);die;
    }
}

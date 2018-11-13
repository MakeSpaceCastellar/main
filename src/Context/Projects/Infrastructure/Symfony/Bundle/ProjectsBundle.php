<?php

declare(strict_types=1);

namespace MakeSpace\Context\Projects\Infrastructure\Symfony\Bundle;

use MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CachedQueryBusCompilerPass;
use MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CommandBusCompilerPass;
use MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\QueryBusCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ProjectsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new QueryBusCompilerPass('makespace.projects.query'));
        $container->addCompilerPass(new CachedQueryBusCompilerPass('makespace.projects.query'));
        $container->addCompilerPass(new CommandBusCompilerPass('makespace.projects.command'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('makespace.projects.database'));
    }
}

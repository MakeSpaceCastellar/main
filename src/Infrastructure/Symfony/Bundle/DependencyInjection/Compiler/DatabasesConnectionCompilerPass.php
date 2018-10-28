<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use function Lambdish\phunctional\each;

final class DatabasesConnectionCompilerPass implements CompilerPassInterface
{
    const DATABASE_CONNECTIONS_SERVICE = 'makespace.infrastructure.database_connections';

    private $tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function process(ContainerBuilder $container)
    {
        $databasesConnectionsService = $container->findDefinition(self::DATABASE_CONNECTIONS_SERVICE);
        $databasesConnectionsIds     = $container->findTaggedServiceIds($this->tag);

        each($this->addDatabasesConnections($databasesConnectionsService, $container), $databasesConnectionsIds);
    }

    private function addDatabasesConnections(Definition $connectionsService, ContainerBuilder $container)
    {
        return function (array $attributes, $databaseConnectionServiceId) use ($connectionsService, $container) {
            $connectionsService->addMethodCall(
                'set',
                [$databaseConnectionServiceId, new Reference($databaseConnectionServiceId)]
            );
        };
    }
}

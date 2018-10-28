<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Doctrine;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;

final class DoctrineEntityManagerFactory
{
    public static function create(array $parameters, bool $isDevMode)
    {
        return EntityManager::create($parameters, self::createConfiguration($isDevMode));
    }

    private static function createConfiguration(bool $isDevMode)
    {
        $config         = Setup::createConfiguration($isDevMode, null, new ArrayCache());
        $config->setMetadataDriverImpl(new SimplifiedYamlDriver([]));

        return $config;
    }
}

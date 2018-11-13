<?php

declare(strict_types=1);

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    FOS\JsRoutingBundle\FOSJsRoutingBundle::class         => ['all' => true],

    JMS\SerializerBundle\JMSSerializerBundle::class                                => ['all' => true],
    Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle::class           => ['all' => true],
    Nmure\CrawlerDetectBundle\CrawlerDetectBundle::class                           => ['all' => true],
    Symfony\Bundle\DebugBundle\DebugBundle::class                                  => [
        'dev'  => true,
        'test' => true
    ],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class                            => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class                                    => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class                      => [
        'dev'  => true,
        'test' => true
    ],
    Aws\Symfony\AwsBundle::class                                                   => ['all' => true],
    Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle::class           => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class                           => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class               => ['dev' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class                              => ['all' => true],
    Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class                      => ['all' => true],
    MakeSpace\Infrastructure\Symfony\Bundle\InfrastructureBundle::class            => ['all' => true],
    MakeSpace\Shared\Infrastructure\Symfony\Bundle\SharedBundle::class             => ['all' => true],
    MakeSpace\Context\Projects\Infrastructure\Symfony\Bundle\ProjectsBundle::class => ['all' => true],
];

<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class DomainEventPublisherCompilerPass implements CompilerPassInterface
{
    const SERVICE_ID_WHERE_REGISTER_SUBSCRIBERS   = 'makespace.infrastructure.domain_event_publisher_sync';
    const SERVICE_ID_WHERE_REGISTER_EVENT_MAPPING = 'makespace.infrastructure.domain_event_mapping';

    private $tag;
    private $methodMapper;

    public function __construct($tag)
    {
        $this->tag          = $tag;
        $this->methodMapper = new CallableFirstParameterExtractor();
    }

    public function process(ContainerBuilder $container)
    {
        $domainEventPublisher = $container->findDefinition(self::SERVICE_ID_WHERE_REGISTER_SUBSCRIBERS);
        $subscriberServiceIds = $container->findTaggedServiceIds($this->tag);

        foreach ($subscriberServiceIds as $id => $unused) {
            $subscriber = $container->findDefinition($id);
            $this->registerSubscriber($subscriber->getClass(), $id, $domainEventPublisher);
        }
    }

    private function registerSubscriber(
        $subscriberClass,
        $subscriberServiceId,
        Definition $publisher
    ) {
        $events = $subscriberClass::subscribedTo();

        foreach ($events as $eventClass) {
            $publisher->addMethodCall('register', [$eventClass, new Reference($subscriberServiceId)]);
        }
    }
}

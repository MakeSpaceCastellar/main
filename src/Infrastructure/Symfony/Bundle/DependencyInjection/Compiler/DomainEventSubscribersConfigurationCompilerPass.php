<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use function Lambdish\phunctional\each;
use function Lambdish\phunctional\get;
use function Lambdish\phunctional\last;
use function Lambdish\phunctional\map;

class DomainEventSubscribersConfigurationCompilerPass implements CompilerPassInterface
{
    const DOMAIN_EVENT_CONFIGURATION_SERVICE = 'makespace.infrastructure.domain_event_subscribers_configuration';
    const SUBSCRIBERS_MAPPING_SERVICE        = 'makespace.infrastructure.subscribers_mapping';
    const EVENT_MAPPING_SERVICE              = 'makespace.infrastructure.domain_event_mapping';
    private $tag;
    private $methodMapper;

    public function __construct($tag)
    {
        $this->tag          = $tag;
        $this->methodMapper = new CallableFirstParameterExtractor();
    }

    public function process(ContainerBuilder $container)
    {
        $domainEventConfiguration = $container->findDefinition(self::DOMAIN_EVENT_CONFIGURATION_SERVICE);
        $subscribersMapping       = $container->findDefinition(self::SUBSCRIBERS_MAPPING_SERVICE);
        $subscribersIds           = $container->findTaggedServiceIds($this->tag);

        each(
            $this->addSubscriberConfiguration($domainEventConfiguration, $subscribersMapping, $container),
            $subscribersIds
        );
    }

    private function addSubscriberConfiguration(
        Definition $domainEventConfiguration,
        Definition $subscribersMapping,
        ContainerBuilder $container
    ) {
        return function (
            array $attributes,
            $subscriberServiceId
        ) use (
            $domainEventConfiguration,
            $subscribersMapping,
            $container
        ) {
            $subscriber = $container->findDefinition($subscriberServiceId);

            $subscriberName  = $this->extractSubscriberName($subscriberServiceId);
            $subscriberClass = $subscriber->getClass();
            $events          = $subscriberClass::subscribedTo();

            $config = array_merge(
                get(0, $attributes, []),
                [
                    'name'              => $subscriberName,
                    'subscribed_events' => map($this->eventNameExtractor(), $events),
                ]
            );

            $domainEventConfiguration->addMethodCall('set', [$subscriberClass, $config]);
            $subscribersMapping->addMethodCall('add', [$subscriberName, $subscriberClass]);
        };
    }

    private function extractSubscriberName($subscriberServiceId)
    {
        return last(explode('.', $subscriberServiceId));
    }

    private function eventNameExtractor()
    {
        return function ($eventClass) {
            return $eventClass::eventName();
        };
    }
}

<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Bus\Event;

final class DomainEventSubscriberConfig
{
    private static $defaultConfig = [
        'processes' => 1,
        'priority'  => 0,
    ];

    private $config;

    public function __construct(array $config)
    {
        $this->config = array_merge(self::$defaultConfig, $config);
    }

    public function name(): string
    {
        return $this->config['name'];
    }

    public function processes()
    {
        return $this->config['processes'];
    }

    public function priority()
    {
        return $this->config['priority'];
    }

    public function sqsQueue(): string
    {
        return $this->config['sqs_queue'];
    }

    public function subscribedEvents(): array
    {
        return $this->config['subscribed_events'];
    }

    public static function blank()
    {
        return new self([]);
    }
}

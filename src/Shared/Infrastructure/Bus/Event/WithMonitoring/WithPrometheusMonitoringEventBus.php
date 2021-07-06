<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Infrastructure\Bus\Event\WithMonitoring;

use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;
use ShopSaas\Shared\Infrastructure\Monitoring\PrometheusMonitor;
use function Lambdish\Phunctional\each;

final class WithPrometheusMonitoringEventBus implements EventBus
{
    public function __construct(private PrometheusMonitor $monitor, private string $appName, private EventBus $bus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        $counter = $this->monitor->registry()->getOrRegisterCounter(
            $this->appName,
            'domain_event',
            'Domain Events',
            ['name']
        );

        each(fn(DomainEvent $event) => $counter->inc(['name' => $event::eventName()]), $events);

        $this->bus->publish(...$events);
    }
}

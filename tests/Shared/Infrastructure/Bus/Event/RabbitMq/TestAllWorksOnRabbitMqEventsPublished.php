<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use ShopSaas\Marketplace\Courses\Domain\CourseCreatedDomainEvent;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use ShopSaas\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class TestAllWorksOnRabbitMqEventsPublished implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [
            CourseCreatedDomainEvent::class,
            CoursesCounterIncrementedDomainEvent::class,
        ];
    }

    public function __invoke(CourseCreatedDomainEvent|CoursesCounterIncrementedDomainEvent $event)
    {
    }
}

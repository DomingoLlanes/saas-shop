<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Application\Create;

use ShopSaas\Marketplace\Courses\Domain\CourseCreatedDomainEvent;
use ShopSaas\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class CreateBackofficeCourseOnCourseCreated implements DomainEventSubscriber
{
    public function __construct(private BackofficeCourseCreator $creator)
    {
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event): void
    {
        $this->creator->create($event->aggregateId(), $event->name(), $event->duration());
    }
}

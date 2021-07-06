<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Application\Increment;

use ShopSaas\Marketplace\Courses\Domain\CourseCreatedDomainEvent;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class IncrementCoursesCounterOnCourseCreated implements DomainEventSubscriber
{
    public function __construct(private CoursesCounterIncrementer $incrementer)
    {
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event): void
    {
        $courseId = new CourseId($event->aggregateId());

        apply($this->incrementer, [$courseId]);
    }
}

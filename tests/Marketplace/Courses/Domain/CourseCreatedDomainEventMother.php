<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseCreatedDomainEvent;
use ShopSaas\Marketplace\Courses\Domain\CourseDuration;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;

final class CourseCreatedDomainEventMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): CourseCreatedDomainEvent {
        return new CourseCreatedDomainEvent(
            $id?->value() ?? CourseIdMother::create()->value(),
            $name?->value() ?? CourseNameMother::create()->value(),
            $duration?->value() ?? CourseDurationMother::create()->value()
        );
    }

    public static function fromCourse(Course $course): CourseCreatedDomainEvent
    {
        return self::create($course->id(), $course->name(), $course->duration());
    }
}

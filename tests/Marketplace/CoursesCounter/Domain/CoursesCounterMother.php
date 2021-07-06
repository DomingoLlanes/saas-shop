<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\CoursesCounter\Domain;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounter;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterId;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterTotal;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseIdMother;
use ShopSaas\Tests\Shared\Domain\Repeater;

final class CoursesCounterMother
{
    public static function create(
        ?CoursesCounterId $id = null,
        ?CoursesCounterTotal $total = null,
        CourseId ...$existingCourses
    ): CoursesCounter {
        return new CoursesCounter(
            $id ?? CoursesCounterIdMother::create(),
            $total ?? CoursesCounterTotalMother::create(),
            ...count($existingCourses) ? $existingCourses : Repeater::random(fn() => CourseIdMother::create())
        );
    }

    public static function withOne(CourseId $courseId): CoursesCounter
    {
        return self::create(CoursesCounterIdMother::create(), CoursesCounterTotalMother::one(), $courseId);
    }

    public static function incrementing(CoursesCounter $existingCounter, CourseId $courseId): CoursesCounter
    {
        return self::create(
            $existingCounter->id(),
            CoursesCounterTotalMother::create($existingCounter->total()->value() + 1),
            ...array_merge($existingCounter->existingCourses(), [$courseId])
        );
    }
}

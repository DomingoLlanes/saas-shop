<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Courses\Application\Create\CreateCourseCommand;
use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseDuration;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;

final class CourseMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): Course {
        return new Course(
            $id ?? CourseIdMother::create(),
            $name ?? CourseNameMother::create(),
            $duration ?? CourseDurationMother::create()
        );
    }

    public static function fromRequest(CreateCourseCommand $request): Course
    {
        return self::create(
            CourseIdMother::create($request->id()),
            CourseNameMother::create($request->name()),
            CourseDurationMother::create($request->duration())
        );
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Courses\Domain;

use ShopSaas\Backoffice\Courses\Domain\BackofficeCourse;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseDurationMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseIdMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseNameMother;

final class BackofficeCourseMother
{
    public static function create(?string $id = null, ?string $name = null, ?string $duration = null): BackofficeCourse
    {
        return new BackofficeCourse(
            $id ?? CourseIdMother::create()->value(),
            $name ?? CourseNameMother::create()->value(),
            $duration ?? CourseDurationMother::create()->value()
        );
    }
}

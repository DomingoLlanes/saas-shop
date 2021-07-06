<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Application\Create;

use ShopSaas\Marketplace\Courses\Application\Create\CreateCourseCommand;
use ShopSaas\Marketplace\Courses\Domain\CourseDuration;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseDurationMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseIdMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseNameMother;

final class CreateCourseCommandMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): CreateCourseCommand {
        return new CreateCourseCommand(
            $id?->value() ?? CourseIdMother::create()->value(),
            $name?->value() ?? CourseNameMother::create()->value(),
            $duration?->value() ?? CourseDurationMother::create()->value()
        );
    }
}

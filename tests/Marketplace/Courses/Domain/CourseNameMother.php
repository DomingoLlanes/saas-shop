<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class CourseNameMother
{
    public static function create(?string $value = null): CourseName
    {
        return new CourseName($value ?? WordMother::create());
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Tests\Shared\Domain\UuidMother;

final class CourseIdMother
{
    public static function create(?string $value = null): CourseId
    {
        return new CourseId($value ?? UuidMother::create());
    }
}

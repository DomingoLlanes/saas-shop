<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Infrastructure\Persistence\Doctrine;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CourseCounterIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CoursesCounterId::class;
    }
}

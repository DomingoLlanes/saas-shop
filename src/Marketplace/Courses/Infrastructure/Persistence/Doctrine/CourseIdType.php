<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Infrastructure\Persistence\Doctrine;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CourseIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CourseId::class;
    }
}

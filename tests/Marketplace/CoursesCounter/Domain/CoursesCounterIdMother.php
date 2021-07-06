<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\CoursesCounter\Domain;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterId;
use ShopSaas\Tests\Shared\Domain\UuidMother;

final class CoursesCounterIdMother
{
    public static function create(?string $value = null): CoursesCounterId
    {
        return new CoursesCounterId($value ?? UuidMother::create());
    }
}

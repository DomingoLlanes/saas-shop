<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\CoursesCounter\Application\Find;

use ShopSaas\Marketplace\CoursesCounter\Application\Find\AuthUserResponse;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterTotal;
use ShopSaas\Tests\Marketplace\CoursesCounter\Domain\CoursesCounterTotalMother;

final class CoursesCounterResponseMother
{
    public static function create(?CoursesCounterTotal $total = null): AuthUserResponse
    {
        return new AuthUserResponse($total?->value() ?? CoursesCounterTotalMother::create()->value());
    }
}

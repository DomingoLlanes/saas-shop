<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Domain\Criteria;

use ShopSaas\Shared\Domain\Criteria\OrderBy;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class OrderByMother
{
    public static function create(?string $fieldName = null): OrderBy
    {
        return new OrderBy($fieldName ?? WordMother::create());
    }
}

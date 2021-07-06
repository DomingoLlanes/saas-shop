<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Domain\Criteria;

use ShopSaas\Shared\Domain\Criteria\FilterValue;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class FilterValueMother
{
    public static function create(?string $value = null): FilterValue
    {
        return new FilterValue($value ?? WordMother::create());
    }
}

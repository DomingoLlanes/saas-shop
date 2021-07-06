<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Domain\Criteria;

use ShopSaas\Shared\Domain\Criteria\FilterField;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class FilterFieldMother
{
    public static function create(?string $fieldName = null): FilterField
    {
        return new FilterField($fieldName ?? WordMother::create());
    }
}

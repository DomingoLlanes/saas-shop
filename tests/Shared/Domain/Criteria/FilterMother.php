<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Domain\Criteria;

use ShopSaas\Shared\Domain\Criteria\Filter;
use ShopSaas\Shared\Domain\Criteria\FilterField;
use ShopSaas\Shared\Domain\Criteria\FilterOperator;
use ShopSaas\Shared\Domain\Criteria\FilterValue;

final class FilterMother
{
    public static function create(
        ?FilterField $field = null,
        ?FilterOperator $operator = null,
        ?FilterValue $value = null
    ): Filter {
        return new Filter(
            $field ?? FilterFieldMother::create(),
            $operator ?? FilterOperator::random(),
            $value ?? FilterValueMother::create()
        );
    }

    /** @param string[] $values */
    public static function fromValues(array $values): Filter
    {
        return Filter::fromValues($values);
    }
}

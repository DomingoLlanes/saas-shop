<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Domain;

use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Tests\Shared\Domain\UuidMother;

final class CustomerAssociatedIdMother
{
    public static function create(?string $value = null): CustomerAssociatedId
    {
        return new CustomerAssociatedId($value ?? UuidMother::create());
    }
}

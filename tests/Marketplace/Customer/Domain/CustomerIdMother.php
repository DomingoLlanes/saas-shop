<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Domain;

use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Tests\Shared\Domain\UuidMother;

final class CustomerIdMother
{
    public static function create(?string $value = null): CustomerId
    {
        return new CustomerId($value ?? UuidMother::create());
    }
}

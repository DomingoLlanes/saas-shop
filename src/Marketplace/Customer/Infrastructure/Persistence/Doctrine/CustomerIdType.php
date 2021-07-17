<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Infrastructure\Persistence\Doctrine;

use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CustomerIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CustomerId::class;
    }
}

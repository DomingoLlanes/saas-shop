<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Domain;

use ShopSaas\Marketplace\Customer\Domain\Customer;
use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Marketplace\Customer\Domain\CustomerUsername;

final class CustomerMother
{
    public static function create(
        ?CustomerId $id = null,
        ?CustomerAssociatedId $associatedId = null,
        ?CustomerUsername $username = null
    ): Customer {
        return new Customer(
            $id ?? CustomerIdMother::create(),
            $associatedId ?? CustomerAssociatedIdMother::create(),
            $username ?? CustomerUsernameMother::create()
        );
    }
}

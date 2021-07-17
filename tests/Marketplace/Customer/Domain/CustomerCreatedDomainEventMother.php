<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Domain;

use ShopSaas\Marketplace\Customer\Domain\Customer;
use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Marketplace\Customer\Domain\CustomerCreatedDomainEvent;
use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Marketplace\Customer\Domain\CustomerUsername;

final class CustomerCreatedDomainEventMother
{
    public static function create(
        ?CustomerId $id = null,
        ?CustomerAssociatedId $associatedId = null,
        ?CustomerUsername $username = null
    ): CustomerCreatedDomainEvent {
        return new CustomerCreatedDomainEvent(
            $id?->value() ?? CustomerIdMother::create()->value(),
            $associatedId?->value() ?? CustomerAssociatedIdMother::create()->value(),
            $username?->value() ?? CustomerUsernameMother::create()->value()
        );
    }

    public static function fromCustomer(Customer $customer): CustomerCreatedDomainEvent
    {
        return self::create($customer->id(), $customer->associatedId(), $customer->username());
    }
}

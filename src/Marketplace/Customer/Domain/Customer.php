<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Domain;

use ShopSaas\Shared\Domain\Aggregate\AggregateRoot;

final class Customer extends AggregateRoot
{
    public function __construct(
        private CustomerId $id,
        private CustomerAssociatedId $associatedId,
        private CustomerUsername $username
    )
    {
    }

    public static function create(CustomerId $id, CustomerAssociatedId $associatedId, CustomerUsername $username): self
    {
        $customer = new self($id, $associatedId, $username);

        $customer->record(
            new CustomerCreatedDomainEvent(
                $id->value(),
                $associatedId->value(),
                $username->value()
            )
        );

        return $customer;
    }

    public function id(): CustomerId
    {
        return $this->id;
    }

    public function associatedId(): CustomerAssociatedId
    {
        return $this->associatedId;
    }

    public function username(): CustomerUsername
    {
        return $this->username;
    }
}

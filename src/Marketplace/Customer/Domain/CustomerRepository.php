<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Domain;

interface CustomerRepository
{
    public function search(CustomerId $customerId): ?Customer;
    public function searchByAssociatedId(CustomerAssociatedId $associatedId): ?Customer;
    public function save(Customer $customer): void;
}

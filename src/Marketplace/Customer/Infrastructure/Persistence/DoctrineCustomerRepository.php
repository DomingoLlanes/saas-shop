<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Infrastructure\Persistence;

use ShopSaas\Marketplace\Customer\Domain\Customer;
use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Marketplace\Customer\Domain\CustomerRepository;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCustomerRepository extends DoctrineRepository implements CustomerRepository
{
    public function save(Customer $customer): void
    {
        $this->persist($customer);
    }

    public function search(CustomerId $id): ?Customer
    {
        return $this->repository(Customer::class)->find($id->value());
    }

    public function searchByAssociatedId(CustomerAssociatedId $associatedId): ?Customer
    {
        return $this->repository(Customer::class)->findOneBy([
            'associated_id.value' => $associatedId->value(),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Application\Create;

use ShopSaas\Marketplace\Customer\Domain\Customer;
use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Marketplace\Customer\Domain\CustomerId;
use ShopSaas\Marketplace\Customer\Domain\CustomerRepository;
use ShopSaas\Marketplace\Customer\Domain\CustomerUsername;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;
use ShopSaas\Shared\Domain\UuidGenerator;

final class CustomerCreator
{
    public function __construct(
        private CustomerRepository $repository,
        private UuidGenerator $generator,
        private EventBus $bus
    ) {
    }

    public function __invoke(CustomerAssociatedId $associatedId, CustomerUsername $username): void
    {
        $customer = $this->repository->searchByAssociatedId($associatedId);

        if (null === $customer) {
            $id = new CustomerId($this->generator->generate());
            $customer = Customer::create($id, $associatedId, $username);
            $this->repository->save($customer);
            $this->bus->publish(...$customer->pullDomainEvents());
        }
    }
}

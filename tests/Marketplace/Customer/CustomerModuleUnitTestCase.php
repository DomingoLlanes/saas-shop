<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer;

use ShopSaas\Marketplace\Customer\Domain\Customer;
use ShopSaas\Marketplace\Customer\Domain\CustomerRepository;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CustomerModuleUnitTestCase extends UnitTestCase
{
    private CustomerRepository|MockInterface|null $repository;

    protected function shouldSave(Customer $customer): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with($this->similarTo($customer))
            ->andReturnNull();
    }

    protected function shouldSearch(?Customer $customer): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($customer);
    }

    protected function shouldSearchByAssociatedId(?Customer $customer): void
    {
        $this->repository()
            ->shouldReceive('searchByAssociatedId')
            ->once()
            ->andReturn($customer);
    }

    protected function repository(): CustomerRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(CustomerRepository::class);
    }
}

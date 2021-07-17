<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Application\Create;

use ShopSaas\Marketplace\Customer\Application\Create\CreateCustomerOnAuthUserRegistered;
use ShopSaas\Marketplace\Customer\Application\Create\CustomerCreator;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserRegisteredDomainEventMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseCreatedDomainEventMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseIdMother;
use ShopSaas\Tests\Marketplace\CoursesCounter\Domain\CoursesCounterIncrementedDomainEventMother;
use ShopSaas\Tests\Marketplace\CoursesCounter\Domain\CoursesCounterMother;
use ShopSaas\Tests\Marketplace\Customer\CustomerModuleUnitTestCase;
use ShopSaas\Tests\Marketplace\Customer\Domain\CustomerAssociatedIdMother;
use ShopSaas\Tests\Marketplace\Customer\Domain\CustomerCreatedDomainEventMother;
use ShopSaas\Tests\Marketplace\Customer\Domain\CustomerIdMother;
use ShopSaas\Tests\Marketplace\Customer\Domain\CustomerMother;
use ShopSaas\Tests\Marketplace\Customer\Domain\CustomerUsernameMother;

final class CreateCustomerOnAuthUserRegisteredTest extends CustomerModuleUnitTestCase
{
    private CreateCustomerOnAuthUserRegistered|null $subscriber;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subscriber = new CreateCustomerOnAuthUserRegistered(
            new CustomerCreator(
                $this->repository(),
                $this->uuidGenerator(),
                $this->eventBus()
            )
        );
    }

    /** @test */
    public function it_should_create_customer(): void
    {
        $event = AuthUserRegisteredDomainEventMother::create();

        $customerId           = CustomerIdMother::create();
        $customerAssociatedId = CustomerAssociatedIdMother::create($event->aggregateId());
        $domainEventBody      = $event->toPrimitives();
        $customerUsername     = CustomerUsernameMother::create($domainEventBody['username']);

        $customerCreated = CustomerMother::create($customerId, $customerAssociatedId, $customerUsername);
        $domainEvent     = CustomerCreatedDomainEventMother::fromCustomer($customerCreated);

        $this->shouldSearchByAssociatedId(null);
        $this->shouldSave($customerCreated);
        $this->shouldPublishDomainEvent($domainEvent);
        $this->shouldGenerateUuid($customerId->value());

        $this->notify($event, $this->subscriber);
    }

    /** @test */
    public function it_should_not_create_an_already_created_customer(): void
    {
        $event = AuthUserRegisteredDomainEventMother::create();

        $customerId           = CustomerIdMother::create();
        $customerAssociatedId = CustomerAssociatedIdMother::create($event->aggregateId());
        $domainEventBody      = $event->toPrimitives();
        $customerUsername     = CustomerUsernameMother::create($domainEventBody['username']);

        $customerCreated = CustomerMother::create($customerId, $customerAssociatedId, $customerUsername);

        $this->shouldSearchByAssociatedId($customerCreated);
        $this->shouldNotPublishDomainEvent();

        $this->notify($event, $this->subscriber);
    }
}

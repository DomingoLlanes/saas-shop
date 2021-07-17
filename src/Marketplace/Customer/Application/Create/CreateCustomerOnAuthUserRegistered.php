<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Application\Create;

use ShopSaas\Backoffice\Auth\Domain\AuthUserRegisteredDomainEvent;
use ShopSaas\Marketplace\Customer\Domain\CustomerAssociatedId;
use ShopSaas\Marketplace\Customer\Domain\CustomerUsername;
use ShopSaas\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class CreateCustomerOnAuthUserRegistered implements DomainEventSubscriber
{
    public function __construct(private CustomerCreator $creator)
    {
    }

    public static function subscribedTo(): array
    {
        return [AuthUserRegisteredDomainEvent::class];
    }

    public function __invoke(AuthUserRegisteredDomainEvent $event): void
    {
        $customerAssociatedId = new CustomerAssociatedId($event->aggregateId());
        $customerData = $event->toPrimitives();
        $customerUsername = new CustomerUsername($customerData['username']);

        $this->creator->__invoke($customerAssociatedId, $customerUsername);
    }
}

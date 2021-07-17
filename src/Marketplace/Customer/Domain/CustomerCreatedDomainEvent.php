<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Customer\Domain;

use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;

final class CustomerCreatedDomainEvent extends DomainEvent
{

    public function __construct(
        string $aggregateId,
        private string $associatedId,
        private string $username,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'customer.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent
    {
        return new self($aggregateId, $body['associatedId'], $body['username'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'associatedId' => $this->associatedId,
            'username' => $this->username,
        ];
    }

    public function associatedId(): string
    {
        return $this->associatedId;
    }

    public function username(): string
    {
        return $this->username;
    }
}

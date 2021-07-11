<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Domain;

use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;

final class AuthUserLoggedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $username,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);
    }public static function eventName(): string
{
    return 'auth_user.logged';
}

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent
    {
        return new self($aggregateId, $body['username'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'username' => $this->username,
        ];
    }

    public function username(): string
    {
        return $this->username;
    }
}

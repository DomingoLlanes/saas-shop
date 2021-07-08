<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Domain;

use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;

final class AuthUserRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $username,
        private string $password,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'auth_user.registered';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent
    {
        return new self($aggregateId, $body['username'], $body['password'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}

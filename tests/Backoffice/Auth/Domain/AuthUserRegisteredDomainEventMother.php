<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Backoffice\Auth\Domain\AuthUserRegisteredDomainEvent;

final class AuthUserRegisteredDomainEventMother
{
    public static function create(
        ?AuthId $id = null,
        ?AuthUsername $username = null,
        ?AuthPassword $password = null
    ): AuthUserRegisteredDomainEvent {
        return new AuthUserRegisteredDomainEvent(
            $id?->value() ?? AuthIdMother::create()->value(),
            $username?->value() ?? AuthUsernameMother::create()->value(),
            $password?->value() ?? AuthPasswordMother::create()->value()
        );
    }

    public static function fromAuthUser(AuthUser $user): AuthUserRegisteredDomainEvent
    {
        return self::create($user->id(), $user->username(), $user->password());
    }
}

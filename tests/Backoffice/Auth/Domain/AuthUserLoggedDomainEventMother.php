<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUserLoggedDomainEvent;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;

final class AuthUserLoggedDomainEventMother
{
    public static function create(
        ?AuthId $id = null,
        ?AuthUsername $username = null
    ): AuthUserLoggedDomainEvent {
        return new AuthUserLoggedDomainEvent(
            $id?->value() ?? AuthIdMother::create()->value(),
            $username?->value() ?? AuthUsernameMother::create()->value()
        );
    }

    public static function fromAuthUser(AuthUser $user): AuthUserLoggedDomainEvent
    {
        return self::create($user->id(), $user->username());
    }
}

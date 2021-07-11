<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Domain;

use ShopSaas\Shared\Domain\Aggregate\AggregateRoot;

final class AuthUser extends AggregateRoot
{
    public function __construct(private AuthId $id, private AuthUsername $username, private AuthPassword $password)
    {
    }

    public static function create(AuthId $id, AuthUsername $username, AuthPassword $password): self
    {
        $authUser = new self($id, $username, $password);

        $authUser->record(new AuthUserRegisteredDomainEvent($id->value(), $username->value(), $password->value()));

        return $authUser;
    }

    public static function login(AuthUser $authUser): self
    {
        $authUser->record(new AuthUserLoggedDomainEvent(
            $authUser->id()->value(),
            $authUser->username()->value()
        ));

        return $authUser;
    }

    public function passwordMatches(AuthPlainPassword $password): bool
    {
        return $this->password->validatePassword($password->value());
    }

    public function id(): AuthId
    {
        return $this->id;
    }

    public function username(): AuthUsername
    {
        return $this->username;
    }

    public function password(): AuthPassword
    {
        return $this->password;
    }
}

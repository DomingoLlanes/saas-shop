<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Domain;

use ShopSaas\Shared\Domain\DomainError;

class AuthUserNotFound extends DomainError
{
    public function __construct(private AuthUsername $username)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'auth_user_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The user with username <%s> not found', $this->username->value());
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Domain;

use ShopSaas\Shared\Domain\DomainError;

class AuthUserAlreadyRegistered extends DomainError
{
    public function __construct(private AuthUsername $username)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'auth_user_username_not_valid';
    }

    protected function errorMessage(): string
    {
        return sprintf('The username <%s> is not valid', $this->username->value());
    }
}

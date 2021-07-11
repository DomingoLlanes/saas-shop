<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Authenticate;

use ShopSaas\Shared\Domain\Bus\Command\Command;

final class AuthenticateUserCommand implements Command
{
    public function __construct(private string $username)
    {
    }

    public function username(): string
    {
        return $this->username;
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Authenticate;

use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Command\CommandHandler;

final class AuthenticateUserCommandHandler implements CommandHandler
{
    public function __construct(private UserAuthenticator $authenticator)
    {
    }

    public function __invoke(AuthenticateUserCommand $command): void
    {
        $username = new AuthUsername($command->username());

        $this->authenticator->authenticate($username);
    }
}

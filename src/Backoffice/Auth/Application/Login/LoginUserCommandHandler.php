<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Login;

use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthPlainPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Command\CommandHandler;

class LoginUserCommandHandler implements CommandHandler
{
    public function __construct(private UserLogin $login)
    {
    }

    public function __invoke(LoginUserCommand $command)
    {
        $username = new AuthUsername($command->username());
        $password = new AuthPlainPassword($command->password());

        $this->login->__invoke($username, $password);
    }
}

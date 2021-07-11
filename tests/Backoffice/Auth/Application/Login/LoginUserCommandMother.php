<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Login;

use ShopSaas\Backoffice\Auth\Application\Login\LoginUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthPlainPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthPlainPasswordMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class LoginUserCommandMother
{
    public static function create(
        ?AuthUsername $username = null,
        ?AuthPlainPassword $password = null
    ): LoginUserCommand
    {
        return new LoginUserCommand(
            $username?->value() ?? AuthUsernameMother::create()->value(),
            $password?->value() ?? AuthPlainPasswordMother::create()->value()
        );
    }
}

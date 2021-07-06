<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;

final class AuthUserMother
{
    public static function create(?AuthUsername $username = null, ?AuthPassword $password = null): AuthUser
    {
        return new AuthUser($username ?? AuthUsernameMother::create(), $password ?? AuthPasswordMother::create());
    }

    public static function fromCommand(AuthenticateUserCommand $command): AuthUser
    {
        return self::create(
            AuthUsernameMother::create($command->username()),
            AuthPasswordMother::create($command->password())
        );
    }
}

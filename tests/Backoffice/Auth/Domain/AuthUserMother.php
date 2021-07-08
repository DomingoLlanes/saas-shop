<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;

final class AuthUserMother
{
    public static function create(
        ?AuthId $id = null,
        ?AuthUsername $username = null,
        ?AuthPassword $password = null
    ): AuthUser
    {
        return new AuthUser(
            $id ?? AuthIdMother::create(),
            $username ?? AuthUsernameMother::create(),
            $password ?? AuthPasswordMother::create()
        );
    }

    public static function fromCommand(AuthenticateUserCommand $command): AuthUser
    {
        return self::create(
            AuthIdMother::create(),
            AuthUsernameMother::create($command->username()),
            AuthPasswordMother::create($command->password())
        );
    }

    public static function fromRequest(RegistrarUserCommand $request): AuthUser
    {
        return self::create(
            AuthIdMother::create($request->id()),
            AuthUsernameMother::create($request->username()),
            AuthPasswordMother::create($request->password())
        );
    }
}

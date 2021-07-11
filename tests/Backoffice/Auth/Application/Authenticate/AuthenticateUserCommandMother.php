<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Authenticate;

use ShopSaas\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandMother
{
    public static function create(
        ?AuthUsername $username = null
    ): AuthenticateUserCommand {
        return new AuthenticateUserCommand(
            $username?->value() ?? AuthUsernameMother::create()->value()
        );
    }
}

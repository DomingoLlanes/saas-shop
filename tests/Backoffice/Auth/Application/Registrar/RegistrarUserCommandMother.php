<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Registrar;

use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthPasswordMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class RegistrarUserCommandMother
{
    public static function create(
        ?AuthId $id = null,
        ?AuthUsername $username = null,
        ?AuthPassword $password = null
    ): RegistrarUserCommand
    {
        return new RegistrarUserCommand(
            $id?->value() ?? AuthId::random()->value(),
            $username?->value() ?? AuthUsernameMother::create()->value(),
            $password?->value() ?? AuthPasswordMother::create()->value()
        );
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Domain\AuthPlainPassword;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class AuthPlainPasswordMother
{
    public static function create(?string $value = null): AuthPlainPassword
    {
        return new AuthPlainPassword($value ?? WordMother::create());
    }
}

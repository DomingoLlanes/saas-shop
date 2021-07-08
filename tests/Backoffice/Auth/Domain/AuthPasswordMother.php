<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class AuthPasswordMother
{
    public static function create(?string $value = null): AuthPassword
    {
        return new AuthPassword($value ?? WordMother::create());
    }
}

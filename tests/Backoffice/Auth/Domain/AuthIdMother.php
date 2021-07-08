<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Domain;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Tests\Shared\Domain\UuidMother;

final class AuthIdMother
{
    public static function create(?string $value = null): AuthId
    {
        return new AuthId($value ?? UuidMother::create());
    }
}

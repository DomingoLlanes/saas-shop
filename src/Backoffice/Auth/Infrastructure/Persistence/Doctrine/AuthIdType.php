<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Infrastructure\Persistence\Doctrine;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class AuthIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return AuthId::class;
    }
}

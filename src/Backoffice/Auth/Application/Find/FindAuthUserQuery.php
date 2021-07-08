<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Find;

use ShopSaas\Shared\Domain\Bus\Query\Query;

final class FindAuthUserQuery implements Query
{
    public function __construct(private string $username)
    {
    }

    public function username(): string
    {
        return $this->username;
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Find;

use ShopSaas\Shared\Domain\Bus\Query\Response;

final class AuthUserResponse implements Response
{
    public function __construct(private string $id, private string $username, private string $password)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}

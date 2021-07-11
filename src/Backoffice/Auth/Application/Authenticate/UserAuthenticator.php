<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Authenticate;

use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;

final class UserAuthenticator
{
    public function __construct(private AuthRepository $repository)
    {
    }

    public function authenticate(AuthUsername $username): void
    {
        $auth = $this->repository->search($username);

        $this->ensureUserExist($auth, $username);
    }

    private function ensureUserExist(?AuthUser $auth, AuthUsername $username): void
    {
        if (null === $auth) {
            throw new InvalidAuthUsername($username);
        }
    }
}

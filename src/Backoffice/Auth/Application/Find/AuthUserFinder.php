<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Find;

use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Backoffice\Auth\Domain\AuthUserNotFound;

final class AuthUserFinder
{
    public function __construct(private AuthRepository $repository)
    {
    }

    public function __invoke(AuthUsername $username): AuthUserResponse
    {
        $user = $this->repository->search($username);

        if (null === $user) {
            throw new AuthUserNotFound($username);
        }

        return new AuthUserResponse($user->id()->value(), $user->username()->value(), $user->password()->value());
    }
}

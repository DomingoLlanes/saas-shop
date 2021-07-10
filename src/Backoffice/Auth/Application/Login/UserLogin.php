<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Login;

use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthPlainPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthCredentials;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

class UserLogin
{
    public function __construct(private AuthRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(AuthUsername $username, AuthPlainPassword $password): void
    {
        $authUser = $this->repository->search($username);

        $this->ensureUserExist($authUser, $username);
        $this->ensureCredentialsAreValid($authUser, $password);

        $authUser = AuthUser::login($authUser);

        $this->bus->publish(...$authUser->pullDomainEvents());
    }

    private function ensureUserExist(?AuthUser $auth, AuthUsername $username): void
    {
        if (null === $auth) {
            throw new InvalidAuthUsername($username);
        }
    }

    private function ensureCredentialsAreValid(AuthUser $auth, AuthPlainPassword $password): void
    {
        if (!$auth->passwordMatches($password)) {
            throw new InvalidAuthCredentials($auth->username());
        }
    }
}

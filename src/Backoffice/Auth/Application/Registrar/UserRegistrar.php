<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Registrar;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthPlainPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUserAlreadyRegistered;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

class UserRegistrar
{
    public function __construct(private AuthRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(AuthId $id, AuthUsername $username, AuthPlainPassword $password)
    {
        $authUser = $this->repository->search($username);
        $this->ensureUsernameNotExists($authUser);

        $hashedPassword = new AuthPassword($password->value());
        $authUser = AuthUser::create($id, $username, $hashedPassword);

        $this->repository->save($authUser);
        $this->bus->publish(...$authUser->pullDomainEvents());
    }

    private function ensureUsernameNotExists(?AuthUser $authUser): void
    {
        if (null !== $authUser) {
            throw new AuthUserAlreadyRegistered($authUser->username());
        }
    }
}

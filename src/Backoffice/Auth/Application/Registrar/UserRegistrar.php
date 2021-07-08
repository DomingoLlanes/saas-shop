<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Registrar;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

class UserRegistrar
{
    public function __construct(private AuthRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(AuthId $id, AuthUsername $username, AuthPassword $password)
    {
        $authUser = AuthUser::create($id, $username, $password);

        $this->repository->save($authUser);
        $this->bus->publish(...$authUser->pullDomainEvents());
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Infrastructure\Persistence;

use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineAuthRepository extends DoctrineRepository implements AuthRepository
{
    public function save(AuthUser $user): void
    {
        $this->persist($user);
    }

    public function search(AuthUsername $username): ?AuthUser
    {
        return $this->repository(AuthUser::class)->findOneBy([
            'username.value' => $username->value(),
        ]);
    }
}

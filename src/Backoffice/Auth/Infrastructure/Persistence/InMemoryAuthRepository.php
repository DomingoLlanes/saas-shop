<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Infrastructure\Persistence;

use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\UuidGenerator;
use ShopSaas\Shared\Infrastructure\RamseyUuidGenerator;
use function Lambdish\Phunctional\get;

final class InMemoryAuthRepository implements AuthRepository
{
    private $USERS = [
        'javi' => 'barbitas',
        'rafa' => 'pelazo',
    ];

    public function search(AuthUsername $username): ?AuthUser
    {
        $password = get($username->value(), $this->USERS);
        $fakeId = (new RamseyUuidGenerator())->generate();

        return null !== $password ? new AuthUser(new AuthId($fakeId), $username, new AuthPassword($password)) : null;
    }

    public function save(AuthUser $user): void
    {
        $this->USERS[] = [$user->username()->value() => $user->password()->value()];
    }
}

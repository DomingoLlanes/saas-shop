<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Infrastructure;

use ShopSaas\Shared\Domain\PasswordEncoder;

final class PhpPasswordEncoder implements PasswordEncoder
{
    private const MEMORY_COST = 65536;
    private const TIME_COST   = 4;
    private const THREADS     = 1;

    public function encode(string $password): string
    {
        return password_hash($password,
            PASSWORD_ARGON2I,
            [
                'memory_cost' => self::MEMORY_COST,
                'time_cost'   => self::TIME_COST,
                'threads'     => self::THREADS,
            ]);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
}

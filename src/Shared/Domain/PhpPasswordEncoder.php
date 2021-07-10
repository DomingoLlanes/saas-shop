<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain;

final class PhpPasswordEncoder implements PasswordEncoder
{
    private const MEMORY_COST = 65536;
    private const TIME_COST   = 4;
    private const THREADS     = 1;
    private const ALGORITHM   = PASSWORD_ARGON2I;

    public static function encode(string $password): string
    {
        return (self::needsRehash($password))
            ?
            password_hash($password,
                self::ALGORITHM,
                self::defaultOptions()
            )
            :
            $password;
    }

    public static function verify(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    public static function needsRehash(string $hashedPassword): bool
    {
        return password_needs_rehash($hashedPassword, self::ALGORITHM, self::defaultOptions());
    }

    private static function defaultOptions(): array
    {
        return [
            'memory_cost' => self::MEMORY_COST,
            'time_cost'   => self::TIME_COST,
            'threads'     => self::THREADS,
        ];
    }
}

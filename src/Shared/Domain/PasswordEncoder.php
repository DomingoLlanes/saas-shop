<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain;

interface PasswordEncoder
{
    public static function encode(string $password): string;

    public static function verify(string $plainPassword, string $hashedPassword): bool;
}

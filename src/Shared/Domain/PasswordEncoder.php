<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain;

interface PasswordEncoder
{
    public function encode(string $password): string;

    public function verify(string $plainPassword, string $hashedPassword): bool;
}

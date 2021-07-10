<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain\Token;

interface Token
{
    public function encode(array $payload): string;

    public function decode(string $tokenAsString): object;

    public function verify(string $tokenAsString): bool;
}

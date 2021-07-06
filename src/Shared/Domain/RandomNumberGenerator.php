<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain;

interface RandomNumberGenerator
{
    public function generate(): int;
}

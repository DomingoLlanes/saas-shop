<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}

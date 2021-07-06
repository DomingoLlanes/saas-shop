<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure;

use ShopSaas\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
    public function generate(): int
    {
        return 1;
    }
}

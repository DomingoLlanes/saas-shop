<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Domain;

use ShopSaas\Shared\Domain\Collection;

final class Videos extends Collection
{
    protected function type(): string
    {
        return Video::class;
    }
}

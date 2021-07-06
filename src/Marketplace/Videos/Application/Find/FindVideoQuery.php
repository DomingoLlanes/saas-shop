<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Find;

use ShopSaas\Shared\Domain\Bus\Query\Query;

final class FindVideoQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}

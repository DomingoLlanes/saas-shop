<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure\Bus\Query;

use ShopSaas\Shared\Domain\Bus\Query\Response;

final class FakeResponse implements Response
{
    public function __construct(private int $number)
    {
    }

    public function number(): int
    {
        return $this->number;
    }
}

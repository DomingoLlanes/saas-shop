<?php

declare (strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Trim;

use ShopSaas\Shared\Domain\Bus\Command\Command;

final class TrimVideoCommand implements Command
{
    public function __construct(private string $videoId, private int $keepFromSecond, private int $keepToSecond)
    {
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function keepFromSecond(): int
    {
        return $this->keepFromSecond;
    }

    public function keepToSecond(): int
    {
        return $this->keepToSecond;
    }
}

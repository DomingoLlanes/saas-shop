<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Infrastructure\Persistence\Doctrine;

use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class VideoIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return VideoId::class;
    }
}


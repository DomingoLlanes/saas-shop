<?php

declare (strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Trim;

use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Shared\Domain\SecondsInterval;

final class VideoTrimmer
{
    public function trim(VideoId $id, SecondsInterval $interval): void
    {
    }
}

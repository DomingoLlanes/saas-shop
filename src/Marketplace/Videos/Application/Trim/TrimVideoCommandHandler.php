<?php

declare (strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Trim;

use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Shared\Domain\SecondsInterval;

final class TrimVideoCommandHandler
{
    public function __construct(private VideoTrimmer $trimmer)
    {
    }

    public function __invoke(TrimVideoCommand $command)
    {
        $id       = new VideoId($command->videoId());
        $interval = SecondsInterval::fromValues($command->keepFromSecond(), $command->keepToSecond());

        $this->trimmer->trim($id, $interval);
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Find;

use ShopSaas\Marketplace\Videos\Domain\VideoFinder as DomainVideoFinder;
use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Marketplace\Videos\Domain\VideoRepository;

final class VideoFinder
{
    private DomainVideoFinder $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainVideoFinder($repository);
    }

    public function __invoke(VideoId $id)
    {
        return $this->finder->__invoke($id);
    }
}

<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Update;

use ShopSaas\Marketplace\Videos\Domain\VideoFinder;
use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Marketplace\Videos\Domain\VideoRepository;
use ShopSaas\Marketplace\Videos\Domain\VideoTitle;

final class VideoTitleUpdater
{
    private VideoFinder $finder;

    public function __construct(private VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id, VideoTitle $newTitle): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateTitle($newTitle);

        $this->repository->save($video);
    }
}

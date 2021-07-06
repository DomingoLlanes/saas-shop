<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Domain;

final class VideoFinder
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function __invoke(VideoId $id): Video
    {
        $video = $this->repository->search($id);

        if (null === $video) {
            throw new VideoNotFound($id);
        }

        return $video;
    }
}

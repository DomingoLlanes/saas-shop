<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Create;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Marketplace\Shared\Domain\Videos\VideoUrl;
use ShopSaas\Marketplace\Videos\Domain\Video;
use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Marketplace\Videos\Domain\VideoRepository;
use ShopSaas\Marketplace\Videos\Domain\VideoTitle;
use ShopSaas\Marketplace\Videos\Domain\VideoType;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

final class VideoCreator
{
    public function __construct(private VideoRepository $repository, private EventBus $bus)
    {
    }

    public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): void
    {
        $video = Video::create($id, $type, $title, $url, $courseId);

        $this->repository->save($video);

        $this->bus->publish(...$video->pullDomainEvents());
    }
}

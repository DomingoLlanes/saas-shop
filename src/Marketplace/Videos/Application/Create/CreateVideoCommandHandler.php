<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Create;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Marketplace\Shared\Domain\Videos\VideoUrl;
use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Marketplace\Videos\Domain\VideoTitle;
use ShopSaas\Marketplace\Videos\Domain\VideoType;
use ShopSaas\Shared\Domain\Bus\Command\CommandHandler;

final class CreateVideoCommandHandler implements CommandHandler
{
    public function __construct(private VideoCreator $creator)
    {
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id       = new VideoId($command->id());
        $type     = new VideoType($command->type());
        $title    = new VideoTitle($command->title());
        $url      = new VideoUrl($command->url());
        $courseId = new CourseId($command->courseId());

        $this->creator->create($id, $type, $title, $url, $courseId);
    }
}

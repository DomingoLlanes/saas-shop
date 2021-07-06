<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Application\Create;

use ShopSaas\Marketplace\Courses\Domain\CourseDuration;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Bus\Command\CommandHandler;

final class CreateCourseCommandHandler implements CommandHandler
{
    public function __construct(private CourseCreator $creator)
    {
    }

    public function __invoke(CreateCourseCommand $command): void
    {
        $id       = new CourseId($command->id());
        $name     = new CourseName($command->name());
        $duration = new CourseDuration($command->duration());

        $this->creator->__invoke($id, $name, $duration);
    }
}

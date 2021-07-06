<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Application\Create;

use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseDuration;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

final class CourseCreator
{
    public function __construct(private CourseRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $course = Course::create($id, $name, $duration);

        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }
}

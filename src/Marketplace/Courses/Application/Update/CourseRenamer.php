<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Application\Update;

use ShopSaas\Marketplace\Courses\Application\Find\CourseFinder;
use ShopSaas\Marketplace\Courses\Domain\CourseName;
use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;

final class CourseRenamer
{
    private CourseFinder     $finder;

    public function __construct(private CourseRepository $repository, private EventBus $bus)
    {
        $this->finder = new CourseFinder($repository);
    }

    public function __invoke(CourseId $id, CourseName $newName): void
    {
        $course = $this->finder->__invoke($id);

        $course->rename($newName);

        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }
}

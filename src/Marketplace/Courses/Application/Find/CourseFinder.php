<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Application\Find;

use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseNotExist;
use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;

final class CourseFinder
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function __invoke(CourseId $id): Course
    {
        $course = $this->repository->search($id);

        if (null === $course) {
            throw new CourseNotExist($id);
        }

        return $course;
    }
}

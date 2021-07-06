<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Application\SearchAll;

use ShopSaas\Backoffice\Courses\Application\BackofficeCourseResponse;
use ShopSaas\Backoffice\Courses\Application\BackofficeCoursesResponse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourseRepository;
use function Lambdish\Phunctional\map;

final class AllBackofficeCoursesSearcher
{
    public function __construct(private BackofficeCourseRepository $repository)
    {
    }

    public function searchAll(): BackofficeCoursesResponse
    {
        return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->searchAll()));
    }

    private function toResponse(): callable
    {
        return static fn(BackofficeCourse $course) => new BackofficeCourseResponse(
            $course->id(),
            $course->name(),
            $course->duration()
        );
    }
}

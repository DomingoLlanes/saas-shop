<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Application\SearchByCriteria;

use ShopSaas\Backoffice\Courses\Application\BackofficeCourseResponse;
use ShopSaas\Backoffice\Courses\Application\BackofficeCoursesResponse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourseRepository;
use ShopSaas\Shared\Domain\Criteria\Criteria;
use ShopSaas\Shared\Domain\Criteria\Filters;
use ShopSaas\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class BackofficeCoursesByCriteriaSearcher
{
    public function __construct(private BackofficeCourseRepository $repository)
    {
    }

    public function search(Filters $filters, Order $order, ?int $limit, ?int $offset): BackofficeCoursesResponse
    {
        $criteria = new Criteria($filters, $order, $offset, $limit);

        return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->matching($criteria)));
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

<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Infrastructure\Persistence;

use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCourseRepository extends DoctrineRepository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }

    public function search(CourseId $id): ?Course
    {
        return $this->repository(Course::class)->find($id);
    }
}

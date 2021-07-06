<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;

interface CourseRepository
{
    public function save(Course $course): void;

    public function search(CourseId $id): ?Course;
}

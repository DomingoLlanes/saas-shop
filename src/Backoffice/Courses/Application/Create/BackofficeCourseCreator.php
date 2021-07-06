<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Application\Create;

use ShopSaas\Backoffice\Courses\Domain\BackofficeCourse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourseRepository;

final class BackofficeCourseCreator
{
    public function __construct(private BackofficeCourseRepository $repository)
    {
    }

    public function create(string $id, string $name, string $duration): void
    {
        $this->repository->save(new BackofficeCourse($id, $name, $duration));
    }
}

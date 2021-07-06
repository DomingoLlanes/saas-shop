<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses;

use ShopSaas\Marketplace\Courses\Domain\Course;
use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesModuleUnitTestCase extends UnitTestCase
{
    private CourseRepository|MockInterface|null $repository;

    protected function shouldSave(Course $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($course))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(CourseId $id, ?Course $course): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($id))
            ->once()
            ->andReturn($course);
    }

    protected function repository(): CourseRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(CourseRepository::class);
    }
}

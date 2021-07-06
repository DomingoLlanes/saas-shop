<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Domain;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Aggregate\AggregateRoot;
use function Lambdish\Phunctional\search;

final class CoursesCounter extends AggregateRoot
{
    private array $existingCourses;

    public function __construct(
        private CoursesCounterId $id,
        private CoursesCounterTotal $total,
        CourseId ...$existingCourses
    ) {
        $this->existingCourses = $existingCourses;
    }

    public static function initialize(CoursesCounterId $id): self
    {
        return new self($id, CoursesCounterTotal::initialize());
    }

    public function id(): CoursesCounterId
    {
        return $this->id;
    }

    public function total(): CoursesCounterTotal
    {
        return $this->total;
    }

    public function existingCourses(): array
    {
        return $this->existingCourses;
    }

    public function increment(CourseId $courseId): void
    {
        $this->total             = $this->total->increment();
        $this->existingCourses[] = $courseId;

        $this->record(new CoursesCounterIncrementedDomainEvent($this->id()->value(), $this->total()->value()));
    }

    public function hasIncremented(CourseId $courseId): bool
    {
        $existingCourse = search($this->courseIdComparator($courseId), $this->existingCourses());

        return null !== $existingCourse;
    }

    private function courseIdComparator(CourseId $courseId): callable
    {
        return static fn(CourseId $other) => $courseId->equals($other);
    }
}

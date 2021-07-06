<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Application\Increment;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounter;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterId;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterRepository;
use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;
use ShopSaas\Shared\Domain\UuidGenerator;

final class CoursesCounterIncrementer
{
    public function __construct(
        private CoursesCounterRepository $repository,
        private UuidGenerator $uuidGenerator,
        private EventBus $bus
    ) {
    }

    public function __invoke(CourseId $courseId): void
    {
        $counter = $this->repository->search() ?: $this->initializeCounter();

        if (!$counter->hasIncremented($courseId)) {
            $counter->increment($courseId);

            $this->repository->save($counter);
            $this->bus->publish(...$counter->pullDomainEvents());
        }
    }

    private function initializeCounter(): CoursesCounter
    {
        return CoursesCounter::initialize(new CoursesCounterId($this->uuidGenerator->generate()));
    }
}

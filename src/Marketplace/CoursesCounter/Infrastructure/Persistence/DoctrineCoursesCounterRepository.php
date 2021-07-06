<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Infrastructure\Persistence;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounter;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterRepository;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCoursesCounterRepository extends DoctrineRepository implements CoursesCounterRepository
{
    public function save(CoursesCounter $counter): void
    {
        $this->persist($counter);
    }

    public function search(): ?CoursesCounter
    {
        return $this->repository(CoursesCounter::class)->findOneBy([]);
    }
}

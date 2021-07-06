<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Infrastructure\Persistence;

use ShopSaas\Backoffice\Courses\Domain\BackofficeCourse;
use ShopSaas\Backoffice\Courses\Domain\BackofficeCourseRepository;
use ShopSaas\Shared\Domain\Criteria\Criteria;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class MySqlBackofficeCourseRepository extends DoctrineRepository implements BackofficeCourseRepository
{
    public function save(BackofficeCourse $course): void
    {
        $this->persist($course);
    }

    public function searchAll(): array
    {
        return $this->repository(BackofficeCourse::class)->findAll();
    }

    public function matching(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        return $this->repository(BackofficeCourse::class)->matching($doctrineCriteria)->toArray();
    }
}

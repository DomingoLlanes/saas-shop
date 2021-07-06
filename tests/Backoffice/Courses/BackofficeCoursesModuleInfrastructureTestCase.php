<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Courses;

use ShopSaas\Backoffice\Courses\Infrastructure\Persistence\ElasticsearchBackofficeCourseRepository;
use ShopSaas\Backoffice\Courses\Infrastructure\Persistence\MySqlBackofficeCourseRepository;
use ShopSaas\Tests\Backoffice\Shared\Infraestructure\PhpUnit\BackofficeContextInfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeCoursesModuleInfrastructureTestCase extends BackofficeContextInfrastructureTestCase
{
    protected function mySqlRepository(): MySqlBackofficeCourseRepository
    {
        return new MySqlBackofficeCourseRepository($this->service(EntityManager::class));
    }

    protected function elasticRepository(): ElasticsearchBackofficeCourseRepository
    {
        return $this->service(ElasticsearchBackofficeCourseRepository::class);
    }
}

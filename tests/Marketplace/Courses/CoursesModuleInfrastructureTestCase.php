<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses;

use ShopSaas\Marketplace\Courses\Domain\CourseRepository;
use ShopSaas\Tests\Marketplace\Shared\Infrastructure\PhpUnit\MarketplaceContextInfrastructureTestCase;

abstract class CoursesModuleInfrastructureTestCase extends MarketplaceContextInfrastructureTestCase
{
    protected function repository(): CourseRepository
    {
        return $this->service(CourseRepository::class);
    }
}

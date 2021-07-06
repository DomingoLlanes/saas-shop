<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Shared\Infrastructure\PhpUnit;

use ShopSaas\Apps\Marketplace\Backend\MarketplaceBackendKernel;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class MarketplaceContextInfrastructureTestCase extends InfrastructureTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $arranger = new MarketplaceEnvironmentArranger($this->service(EntityManager::class));

        $arranger->arrange();
    }

    protected function tearDown(): void
    {
        $arranger = new MarketplaceEnvironmentArranger($this->service(EntityManager::class));

        $arranger->close();

        parent::tearDown();
    }

    protected function kernelClass(): string
    {
        return MarketplaceBackendKernel::class;
    }
}

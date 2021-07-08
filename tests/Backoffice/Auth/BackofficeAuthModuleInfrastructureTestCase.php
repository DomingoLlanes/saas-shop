<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth;

use ShopSaas\Backoffice\Auth\Infrastructure\Persistence\DoctrineAuthRepository;
use ShopSaas\Tests\Backoffice\Shared\Infraestructure\PhpUnit\BackofficeContextInfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeAuthModuleInfrastructureTestCase extends BackofficeContextInfrastructureTestCase
{
    protected function mySqlRepository(): DoctrineAuthRepository
    {
        return new DoctrineAuthRepository($this->service(EntityManager::class));
    }
}

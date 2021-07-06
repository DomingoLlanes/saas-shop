<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Shared\Infrastructure\PhpUnit;

use ShopSaas\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use ShopSaas\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class MarketplaceEnvironmentArranger implements EnvironmentArranger
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function arrange(): void
    {
        apply(new MySqlDatabaseCleaner(), [$this->entityManager]);
    }

    public function close(): void
    {
    }
}

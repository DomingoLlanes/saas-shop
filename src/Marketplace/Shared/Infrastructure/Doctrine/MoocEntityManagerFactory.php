<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Shared\Infrastructure\Doctrine;

use ShopSaas\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;

final class MoocEntityManagerFactory
{
    private const SCHEMA_PATH = __DIR__ . '/../../../../../etc/databases/marketplace.sql';

    public static function create(array $parameters, string $environment): EntityManagerInterface
    {
        $isDevMode = 'prod' !== $environment;

        $prefixes = array_merge(
            DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Marketplace', 'ShopSaas\Marketplace'),
            DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Backoffice', 'ShopSaas\Backoffice')
        );

        $dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../Marketplace', 'Marketplace');

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $prefixes,
            $isDevMode,
            self::SCHEMA_PATH,
            $dbalCustomTypesClasses
        );
    }
}

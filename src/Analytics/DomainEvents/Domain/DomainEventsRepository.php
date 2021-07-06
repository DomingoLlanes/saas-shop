<?php

declare(strict_types=1);

namespace ShopSaas\Analytics\DomainEvents\Domain;

interface DomainEventsRepository
{
    public function save(AnalyticsDomainEvent $event): void;
}

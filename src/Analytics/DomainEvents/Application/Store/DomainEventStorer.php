<?php

declare(strict_types=1);

namespace ShopSaas\Analytics\DomainEvents\Application\Store;

use ShopSaas\Analytics\DomainEvents\Domain\AnalyticsDomainEvent;
use ShopSaas\Analytics\DomainEvents\Domain\AnalyticsDomainEventAggregateId;
use ShopSaas\Analytics\DomainEvents\Domain\AnalyticsDomainEventBody;
use ShopSaas\Analytics\DomainEvents\Domain\AnalyticsDomainEventId;
use ShopSaas\Analytics\DomainEvents\Domain\AnalyticsDomainEventName;
use ShopSaas\Analytics\DomainEvents\Domain\DomainEventsRepository;

final class DomainEventStorer
{
    public function __construct(private DomainEventsRepository $repository)
    {
    }

    public function store(
        AnalyticsDomainEventId $id,
        AnalyticsDomainEventAggregateId $aggregateId,
        AnalyticsDomainEventName $name,
        AnalyticsDomainEventBody $body
    ): void {
        $domainEvent = new AnalyticsDomainEvent($id, $aggregateId, $name, $body);

        $this->repository->save($domainEvent);
    }
}

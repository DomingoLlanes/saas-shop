<?php

declare(strict_types=1);

namespace ShopSaas\Analytics\DomainEvents\Domain;

final class AnalyticsDomainEvent
{
    public function __construct(
        private AnalyticsDomainEventId $id,
        private AnalyticsDomainEventAggregateId $aggregateId,
        private AnalyticsDomainEventName $name,
        private AnalyticsDomainEventBody $body
    ) {
    }
}

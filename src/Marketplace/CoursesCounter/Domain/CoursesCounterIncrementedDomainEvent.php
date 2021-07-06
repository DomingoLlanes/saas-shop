<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Domain;

use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;

final class CoursesCounterIncrementedDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        private int $total,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'courses_counter.incremented';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['total'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'total' => $this->total,
        ];
    }
}

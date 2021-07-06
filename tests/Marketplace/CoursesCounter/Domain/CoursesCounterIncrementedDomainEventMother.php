<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\CoursesCounter\Domain;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounter;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterId;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterTotal;

final class CoursesCounterIncrementedDomainEventMother
{
    public static function create(
        ?CoursesCounterId $id = null,
        ?CoursesCounterTotal $total = null
    ): CoursesCounterIncrementedDomainEvent {
        return new CoursesCounterIncrementedDomainEvent(
            $id?->value() ?? CoursesCounterIdMother::create()->value(),
            $total?->value() ?? CoursesCounterTotalMother::create()->value()
        );
    }

    public static function fromCounter(CoursesCounter $counter): CoursesCounterIncrementedDomainEvent
    {
        return self::create($counter->id(), $counter->total());
    }
}

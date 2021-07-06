<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure\Bus\Event\MySql;

use ShopSaas\Apps\Marketplace\Backend\MarketplaceBackendKernel;
use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;
use ShopSaas\Shared\Infrastructure\Bus\Event\DomainEventMapping;
use ShopSaas\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use ShopSaas\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineEventBus;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseCreatedDomainEventMother;
use ShopSaas\Tests\Marketplace\CoursesCounter\Domain\CoursesCounterIncrementedDomainEventMother;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

final class MySqlDoctrineEventBusTest extends InfrastructureTestCase
{
    private MySqlDoctrineEventBus|null             $bus;
    private MySqlDoctrineDomainEventsConsumer|null $consumer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bus      = new MySqlDoctrineEventBus($this->service(EntityManager::class));
        $this->consumer = new MySqlDoctrineDomainEventsConsumer(
            $this->service(EntityManager::class),
            $this->service(DomainEventMapping::class)
        );
    }

    /** @test */
    public function it_should_publish_and_consume_domain_events_from_msql(): void
    {
        $domainEvent        = CourseCreatedDomainEventMother::create();
        $anotherDomainEvent = CoursesCounterIncrementedDomainEventMother::create();

        $this->bus->publish($domainEvent, $anotherDomainEvent);

        $this->consumer->consume(
            fn(DomainEvent ...$expectedEvents) => $this->assertContainsEquals($domainEvent, $expectedEvents),
            $eventsToConsume = 2
        );
    }

    protected function kernelClass(): string
    {
        return MarketplaceBackendKernel::class;
    }
}

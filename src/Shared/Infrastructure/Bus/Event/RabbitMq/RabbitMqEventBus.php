<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Infrastructure\Bus\Event\RabbitMq;

use AMQPException;
use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;
use ShopSaas\Shared\Domain\Bus\Event\EventBus;
use ShopSaas\Shared\Infrastructure\Bus\Event\DomainEventJsonSerializer;
use ShopSaas\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineEventBus;
use function Lambdish\Phunctional\each;

final class RabbitMqEventBus implements EventBus
{
    private RabbitMqConnection    $connection;
    private string                $exchangeName;
    private MySqlDoctrineEventBus $failoverPublisher;

    public function __construct(
        RabbitMqConnection $connection,
        string $exchangeName,
        MySqlDoctrineEventBus $failoverPublisher
    ) {
        $this->connection        = $connection;
        $this->exchangeName      = $exchangeName;
        $this->failoverPublisher = $failoverPublisher;
    }

    public function publish(DomainEvent ...$events): void
    {
        each($this->publisher(), $events);
    }

    private function publisher(): callable
    {
        return function (DomainEvent $event) {
            try {
                $this->publishEvent($event);
            } catch (AMQPException $error) {
                $this->failoverPublisher->publish($event);
            }
        };
    }

    private function publishEvent(DomainEvent $event): void
    {
        $body       = DomainEventJsonSerializer::serialize($event);
        $routingKey = $event::eventName();
        $messageId  = $event->eventId();

        $this->connection->exchange($this->exchangeName)->publish(
            $body,
            $routingKey,
            AMQP_NOPARAM,
            [
                'message_id'       => $messageId,
                'content_type'     => 'application/json',
                'content_encoding' => 'utf-8',
            ]
        );
    }
}

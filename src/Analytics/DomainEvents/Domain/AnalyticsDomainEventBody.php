<?php

declare(strict_types=1);

namespace ShopSaas\Analytics\DomainEvents\Domain;

final class AnalyticsDomainEventBody
{
    public function __construct(private array $value)
    {
    }

    public function value(): array
    {
        return $this->value;
    }
}

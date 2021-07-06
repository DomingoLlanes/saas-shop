<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Domain\Criteria;

use ShopSaas\Shared\Domain\Criteria\Order;
use ShopSaas\Shared\Domain\Criteria\OrderBy;
use ShopSaas\Shared\Domain\Criteria\OrderType;

final class OrderMother
{
    public static function create(?OrderBy $orderBy = null, ?OrderType $orderType = null): Order
    {
        return new Order($orderBy ?? OrderByMother::create(), $orderType ?? OrderType::random());
    }

    public static function none(): Order
    {
        return Order::none();
    }
}

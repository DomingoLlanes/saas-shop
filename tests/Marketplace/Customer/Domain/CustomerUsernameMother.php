<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Customer\Domain;

use ShopSaas\Marketplace\Customer\Domain\CustomerUsername;
use ShopSaas\Tests\Shared\Domain\WordMother;

final class CustomerUsernameMother
{
    public static function create(?string $value = null): CustomerUsername
    {
        return new CustomerUsername($value ?? WordMother::create());
    }
}

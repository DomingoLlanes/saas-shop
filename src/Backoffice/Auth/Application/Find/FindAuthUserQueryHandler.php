<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Auth\Application\Find;

use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Query\QueryHandler;

final class FindAuthUserQueryHandler implements QueryHandler
{
    public function __construct(private AuthUserFinder $finder)
    {
    }

    public function __invoke(FindAuthUserQuery $query): AuthUserResponse
    {
        $username = new AuthUsername($query->username());

        return $this->finder->__invoke($username);
    }
}

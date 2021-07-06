<?php

declare(strict_types=1);

namespace ShopSaas\Backoffice\Courses\Application\SearchAll;

use ShopSaas\Backoffice\Courses\Application\BackofficeCoursesResponse;
use ShopSaas\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllBackofficeCoursesQueryHandler implements QueryHandler
{
    public function __construct(private AllBackofficeCoursesSearcher $searcher)
    {
    }

    public function __invoke(SearchAllBackofficeCoursesQuery $query): BackofficeCoursesResponse
    {
        return $this->searcher->searchAll();
    }
}

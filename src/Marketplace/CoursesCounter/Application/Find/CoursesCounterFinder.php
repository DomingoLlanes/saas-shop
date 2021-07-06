<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Application\Find;

use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterNotExist;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterRepository;

final class CoursesCounterFinder
{
    public function __construct(private CoursesCounterRepository $repository)
    {
    }

    public function __invoke(): CoursesCounterResponse
    {
        $counter = $this->repository->search();

        if (null === $counter) {
            throw new CoursesCounterNotExist();
        }

        return new CoursesCounterResponse($counter->total()->value());
    }
}

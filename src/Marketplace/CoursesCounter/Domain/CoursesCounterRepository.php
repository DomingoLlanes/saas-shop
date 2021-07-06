<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\CoursesCounter\Domain;

interface CoursesCounterRepository
{
    public function save(CoursesCounter $counter): void;

    public function search(): ?CoursesCounter;
}

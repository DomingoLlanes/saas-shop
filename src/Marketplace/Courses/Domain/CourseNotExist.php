<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Courses\Domain;

use ShopSaas\Marketplace\Shared\Domain\Courses\CourseId;
use ShopSaas\Shared\Domain\DomainError;

final class CourseNotExist extends DomainError
{
    public function __construct(private CourseId $id)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'course_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The course <%s> does not exist', $this->id->value());
    }
}

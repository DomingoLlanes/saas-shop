<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Marketplace\Courses\Application\Create;

use ShopSaas\Marketplace\Courses\Application\Create\CourseCreator;
use ShopSaas\Marketplace\Courses\Application\Create\CreateCourseCommandHandler;
use ShopSaas\Tests\Marketplace\Courses\CoursesModuleUnitTestCase;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseCreatedDomainEventMother;
use ShopSaas\Tests\Marketplace\Courses\Domain\CourseMother;

final class CreateCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
    private CreateCourseCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateCourseCommandHandler(new CourseCreator($this->repository(), $this->eventBus()));
    }

    /** @test */
    public function it_should_create_a_valid_course(): void
    {
        $command = CreateCourseCommandMother::create();

        $course      = CourseMother::fromRequest($command);
        $domainEvent = CourseCreatedDomainEventMother::fromCourse($course);

        $this->shouldSave($course);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}

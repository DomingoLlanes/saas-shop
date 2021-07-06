<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Backoffice\Frontend\Controller\Courses;

use ShopSaas\Marketplace\CoursesCounter\Application\Find\CoursesCounterResponse;
use ShopSaas\Marketplace\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use ShopSaas\Shared\Domain\ValueObject\Uuid;
use ShopSaas\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CoursesGetWebController extends WebController
{
    public function __invoke(Request $request): Response
    {
        /** @var CoursesCounterResponse $coursesCounterResponse */
        $coursesCounterResponse = $this->ask(new FindCoursesCounterQuery());

        return $this->render(
            'pages/courses/courses.html.twig',
            [
                'title'           => 'Courses',
                'description'     => 'Courses CodelyTV - Backoffice',
                'courses_counter' => $coursesCounterResponse->total(),
                'new_course_id'   => Uuid::random()->value(),
            ]
        );
    }

    protected function exceptions(): array
    {
        return [];
    }
}

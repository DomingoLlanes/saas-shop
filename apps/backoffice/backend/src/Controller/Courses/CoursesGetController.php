<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Backoffice\Backend\Controller\Courses;

use ShopSaas\Backoffice\Courses\Application\BackofficeCourseResponse;
use ShopSaas\Backoffice\Courses\Application\BackofficeCoursesResponse;
use ShopSaas\Backoffice\Courses\Application\SearchByCriteria\SearchBackofficeCoursesByCriteriaQuery;
use ShopSaas\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class CoursesGetController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $limit  = $request->query->get('limit');
        $offset = $request->query->get('offset');

        /** @var BackofficeCoursesResponse $response */
        $response = $this->queryBus->ask(
            new SearchBackofficeCoursesByCriteriaQuery(
                (array) $request->query->get('filters'),
                $request->query->get('order_by'),
                $request->query->get('order'),
                null === $limit ? null : (int) $limit,
                null === $offset ? null : (int) $offset
            )
        );

        return new JsonResponse(
            map(
                fn(BackofficeCourseResponse $course) => [
                    'id'       => $course->id(),
                    'name'     => $course->name(),
                    'duration' => $course->duration(),
                ],
                $response->courses()
            ),
            200,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}

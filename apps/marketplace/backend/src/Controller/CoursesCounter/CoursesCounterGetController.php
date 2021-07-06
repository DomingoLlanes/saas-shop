<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Marketplace\Backend\Controller\CoursesCounter;

use ShopSaas\Marketplace\CoursesCounter\Application\Find\CoursesCounterResponse;
use ShopSaas\Marketplace\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use ShopSaas\Marketplace\CoursesCounter\Domain\CoursesCounterNotExist;
use ShopSaas\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CoursesCounterGetController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        /** @var CoursesCounterResponse $response */
        $response = $this->ask(new FindCoursesCounterQuery());

        return new JsonResponse(
            [
                'total' => $response->total(),
            ]
        );
    }

    protected function exceptions(): array
    {
        return [
            CoursesCounterNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }
}

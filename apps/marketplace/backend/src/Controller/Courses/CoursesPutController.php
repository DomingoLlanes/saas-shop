<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Marketplace\Backend\Controller\Courses;

use ShopSaas\Marketplace\Courses\Application\Create\CreateCourseCommand;
use ShopSaas\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CoursesPutController extends ApiController
{
    public function __invoke(string $id, Request $request): Response
    {
        $this->dispatch(
            new CreateCourseCommand(
                $id,
                $request->request->getAlpha('name'),
                $request->request->getAlpha('duration')
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}

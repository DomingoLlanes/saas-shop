<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Backoffice\Backend\Controller\Auth;

use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthUserAlreadyRegistered;
use ShopSaas\Shared\Infrastructure\RamseyUuidGenerator;
use ShopSaas\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthRegisterPostController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $username = $request->request->getAlpha('username');
        $password = $request->request->getAlpha('password');

        $uuidGenerator = new RamseyUuidGenerator();
        $id            = $uuidGenerator->generate();

        $this->dispatch(
            new RegistrarUserCommand(
                $id,
                $username,
                $password
            )
        );

        return new JsonResponse(
            [
                'id' => $id,
            ],
            Response::HTTP_CREATED
        );
    }

    protected function exceptions(): array
    {
        return [
            AuthUserAlreadyRegistered::class => Response::HTTP_UNPROCESSABLE_ENTITY,
        ];
    }
}

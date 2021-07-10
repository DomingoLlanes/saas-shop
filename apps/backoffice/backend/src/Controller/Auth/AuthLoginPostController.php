<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Backoffice\Backend\Controller\Auth;

use ShopSaas\Backoffice\Auth\Application\Login\LoginUserCommand;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthCredentials;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;
use ShopSaas\Shared\Infrastructure\Symfony\ApiController;
use ShopSaas\Shared\Infrastructure\Token\JWTToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthLoginPostController extends ApiController
{
    public function __invoke(Request $request, JWTToken $JWTToken): JsonResponse
    {
        $username = $request->request->getAlpha('username');
        $password = $request->request->getAlpha('password');

        $this->dispatch(
            new LoginUserCommand(
                $username,
                $password
            )
        );

        return new JsonResponse(
            [
                'data' => $JWTToken->encode([$username]),
            ],
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [
            InvalidAuthUsername::class    => Response::HTTP_UNAUTHORIZED,
            InvalidAuthCredentials::class => Response::HTTP_UNAUTHORIZED,
        ];
    }
}

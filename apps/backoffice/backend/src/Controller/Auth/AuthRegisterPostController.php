<?php

declare(strict_types=1);

namespace ShopSaas\Apps\Backoffice\Backend\Controller\Auth;

use ShopSaas\Backoffice\Auth\Application\Find\FindAuthUserQuery;
use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommand;
use ShopSaas\Backoffice\Auth\Domain\AuthUserAlreadyRegistered;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Backoffice\Auth\Domain\AuthUserNotFound;
use ShopSaas\Shared\Infrastructure\PhpPasswordEncoder;
use ShopSaas\Shared\Infrastructure\RamseyUuidGenerator;
use ShopSaas\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class AuthRegisterPostController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $username = $request->request->getAlpha('username');
        $password = $request->request->getAlpha('password');
        $authUser = null;

        try {
            $authUser = $this->ask(new FindAuthUserQuery($username));
        } catch (HandlerFailedException $handlerFailedException) {
            if (AuthUserNotFound::class !== $handlerFailedException->getPrevious()::class) {
                throw $handlerFailedException;
            }
        }

        if (null !== $authUser) {
            throw new AuthUserAlreadyRegistered(new AuthUsername($username));
        }

        $uuidGenerator   = new RamseyUuidGenerator();
        $id              = $uuidGenerator->generate();
        $passwordEncoder = new PhpPasswordEncoder();
        $password        = $passwordEncoder->encode($password);

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

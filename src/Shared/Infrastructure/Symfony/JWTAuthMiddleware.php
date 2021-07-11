<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Infrastructure\Symfony;

use ShopSaas\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthCredentials;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;
use ShopSaas\Shared\Domain\Bus\Command\CommandBus;
use ShopSaas\Shared\Infrastructure\Token\JWTToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class JWTAuthMiddleware
{
    public function __construct(private CommandBus $bus, private JWTToken $JWTToken)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $shouldAuthenticate = $event->getRequest()->attributes->get('auth', false);

        if ($shouldAuthenticate) {
            $token = $event->getRequest()->headers->get('Authorization');

            if ($this->hasCredentials($token)) {
                $this->askForCredentials($event);
            }

            $verifyToken = $this->JWTToken->verify($token);

            if (!$verifyToken) {
                $this->askForValidCredentials($event);
            }

            $decodedToken = $this->JWTToken->decode($token);

            $this->authenticate($decodedToken->username, $token, $event);
        }
    }

    private function hasCredentials(?string $token): bool
    {
        return null !== $token;
    }

    private function authenticate(string $username, string $token, RequestEvent $event): void
    {
        try {
            $this->bus->dispatch(new AuthenticateUserCommand($username));

            $this->addUserDataToRequest($username, $token, $event);
        } catch (InvalidAuthUsername) {
            $event->setResponse(new JsonResponse(['error' => 'Invalid credentials'], Response::HTTP_FORBIDDEN));
        }
    }

    private function addUserDataToRequest(string $user, string $token, RequestEvent $event): void
    {
        $event->getRequest()->attributes->set('authenticated_username', $user);
        $event->getRequest()->attributes->set('authenticated_token', $token);
    }

    private function askForCredentials(RequestEvent $event): void
    {
        $event->setResponse(
            new Response('', Response::HTTP_UNAUTHORIZED)
        );
    }

    private function askForValidCredentials(RequestEvent $event): void
    {
        $event->setResponse(
            new Response('', Response::HTTP_FORBIDDEN)
        );
    }
}

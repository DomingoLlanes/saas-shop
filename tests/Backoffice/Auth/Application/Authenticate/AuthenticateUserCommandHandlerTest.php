<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Authenticate;

use ShopSaas\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommandHandler;
use ShopSaas\Backoffice\Auth\Application\Authenticate\UserAuthenticator;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthCredentials;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;
use ShopSaas\Tests\Backoffice\Auth\AuthModuleUnitTestCase;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandHandlerTest extends AuthModuleUnitTestCase
{
    private AuthenticateUserCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new AuthenticateUserCommandHandler(new UserAuthenticator($this->repository()));
    }

    /** @test */
    public function it_should_authenticate_a_valid_user(): void
    {
        $command  = AuthenticateUserCommandMother::create();
        $authUser = AuthUserMother::fromCommand($command);

        $this->shouldSearch($authUser->username(), $authUser);

        $this->dispatch($command, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_user_does_not_exist(): void
    {
        $this->expectException(InvalidAuthUsername::class);

        $command  = AuthenticateUserCommandMother::create();
        $username = AuthUsernameMother::create($command->username());

        $this->shouldSearch($username);

        $this->dispatch($command, $this->handler);
    }
}

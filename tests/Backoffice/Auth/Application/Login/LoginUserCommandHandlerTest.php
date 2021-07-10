<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Login;

use ShopSaas\Backoffice\Auth\Application\Login\LoginUserCommandHandler;
use ShopSaas\Backoffice\Auth\Application\Login\UserLogin;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthCredentials;
use ShopSaas\Backoffice\Auth\Domain\InvalidAuthUsername;
use ShopSaas\Tests\Backoffice\Auth\AuthModuleUnitTestCase;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthPasswordMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthPlainPasswordMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserLoggedDomainEventMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class LoginUserCommandHandlerTest extends AuthModuleUnitTestCase
{
    private LoginUserCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new LoginUserCommandHandler(new UserLogin($this->repository(), $this->eventBus()));
    }

    /** @test */
    public function it_should_login_a_valid_user(): void
    {
        $password = AuthPlainPasswordMother::create();
        $authUser = AuthUserMother::create(password: AuthPasswordMother::create($password->value()));

        $domainEvent  = AuthUserLoggedDomainEventMother::fromAuthUser($authUser);
        $loginCommand = LoginUserCommandMother::create(
            $authUser->username(),
            $password
        );

        $this->shouldSearch($authUser->username(), $authUser);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($loginCommand, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_user_does_not_exist(): void
    {
        $this->expectException(InvalidAuthUsername::class);

        $command  = LoginUserCommandMother::create();
        $username = AuthUsernameMother::create($command->username());

        $this->shouldSearch($username);

        $this->dispatch($command, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_password_does_not_math(): void
    {
        $this->expectException(InvalidAuthCredentials::class);

        $command  = LoginUserCommandMother::create();
        $authUser = AuthUserMother::create(username: AuthUsernameMother::create($command->username()));

        $this->shouldSearch($authUser->username(), $authUser);

        $this->dispatch($command, $this->handler);
    }

}

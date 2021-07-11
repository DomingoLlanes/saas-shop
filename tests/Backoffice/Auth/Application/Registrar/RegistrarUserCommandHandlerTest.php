<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Registrar;

use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommandHandler;
use ShopSaas\Backoffice\Auth\Application\Registrar\UserRegistrar;
use ShopSaas\Backoffice\Auth\Domain\AuthUserAlreadyRegistered;
use ShopSaas\Tests\Backoffice\Auth\AuthModuleUnitTestCase;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserRegisteredDomainEventMother;

final class RegistrarUserCommandHandlerTest extends AuthModuleUnitTestCase
{
    private RegistrarUserCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new RegistrarUserCommandHandler(new UserRegistrar($this->repository(), $this->eventBus()));
    }

    /** @test */
    public function it_should_register_a_valid_user(): void
    {
        $command     = RegistrarUserCommandMother::create();
        $authUser    = AuthUserMother::fromRequest($command);
        $domainEvent = AuthUserRegisteredDomainEventMother::fromAuthUser($authUser);

        $this->shouldSearch($authUser->username());
        $this->shouldSave($authUser);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_user_already_exist(): void
    {
        $this->expectException(AuthUserAlreadyRegistered::class);

        $command  = RegistrarUserCommandMother::create();
        $authUser = AuthUserMother::fromRequest($command);

        $this->shouldSearch($authUser->username(), $authUser);
        $this->shouldNotPublishDomainEvent();

        $this->dispatch($command, $this->handler);
    }
}

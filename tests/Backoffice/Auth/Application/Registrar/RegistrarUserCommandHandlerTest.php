<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Application\Registrar;

use ShopSaas\Backoffice\Auth\Application\Registrar\RegistrarUserCommandHandler;
use ShopSaas\Backoffice\Auth\Application\Registrar\UserRegistrar;
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

        $this->shouldSave($authUser);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}

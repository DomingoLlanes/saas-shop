<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth;

use ShopSaas\Backoffice\Auth\Domain\AuthRepository;
use ShopSaas\Backoffice\Auth\Domain\AuthUser;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Event\DomainEvent;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AuthModuleUnitTestCase extends UnitTestCase
{
    private AuthRepository|MockInterface|null $repository;

    protected function shouldSearch(AuthUsername $username, AuthUser $authUser = null): void
    {
        $this->repository()
             ->shouldReceive('search')
             ->with($this->similarTo($username))
             ->once()
             ->andReturn($authUser);
    }

    protected function shouldSave(AuthUser $authUser): void
    {
        $this->repository()
             ->shouldReceive('save')
             ->with($this->similarTo($authUser))
             ->once()
             ->andReturnNull();
    }

    protected function shouldPublishDomainEvent(DomainEvent $domainEvent): void
    {
        $this->eventBus()
             ->shouldReceive('publish')
             ->with($this->similarTo($domainEvent))
             ->andReturnNull();
    }

    protected function shouldNotPublishDomainEvent(): void
    {
        $this->eventBus()
             ->shouldReceive('publish')
             ->withNoArgs()
             ->andReturnNull();
    }

    protected function repository(): AuthRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(AuthRepository::class);
    }
}

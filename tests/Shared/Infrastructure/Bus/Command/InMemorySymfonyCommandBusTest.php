<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure\Bus\Command;

use ShopSaas\Shared\Domain\Bus\Command\Command;
use ShopSaas\Shared\Infrastructure\Bus\Command\CommandNotRegisteredError;
use ShopSaas\Shared\Infrastructure\Bus\Command\InMemorySymfonyCommandBus;
use ShopSaas\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;
use RuntimeException;

final class InMemorySymfonyCommandBusTest extends UnitTestCase
{
    private InMemorySymfonyCommandBus|null $commandBus;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commandBus = new InMemorySymfonyCommandBus([$this->commandHandler()]);
    }

    /** @test */
    public function it_should_be_able_to_handle_a_command(): void
    {
        $this->expectException(RuntimeException::class);

        $this->commandBus->dispatch(new FakeCommand());
    }

    /** @test */
    public function it_should_raise_an_exception_dispatching_a_non_registered_command(): void
    {
        $this->expectException(CommandNotRegisteredError::class);

        $this->commandBus->dispatch($this->command());
    }

    private function commandHandler(): object
    {
        return new class {
            public function __invoke(FakeCommand $command)
            {
                throw new RuntimeException('This works fine!');
            }
        };
    }

    private function command(): Command|MockInterface
    {
        return $this->mock(Command::class);
    }
}

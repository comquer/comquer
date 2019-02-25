<?php declare(strict_types=1);

namespace CQRSTest\Command;

use CQRS\Command\CommandBus;
use CQRS\Command\RegisteredCommands;
use CQRS\HandlerProvider;
use CQRSTest\Fixture\Command\DoSomething\DoSomething;
use CQRSTest\Fixture\Command\DoSomething\DoSomethingHandler;
use PHPUnit\Framework\TestCase;

class CommandBusConfigTest extends TestCase
{
    /** @test */
    function instantiate()
    {
        $commandBus = new CommandBus(
            new RegisteredCommands(),
            $this->createMock(HandlerProvider::class)
        );

        self::assertInstanceOf(
            CommandBus::class,
            $commandBus
        );
    }

    /** @test */
    function handle()
    {
        $command = new DoSomething('something id');

        $handlerProvider = $this->createMock(HandlerProvider::class);
        $handlerProvider
            ->method('get')
            ->with(DoSomethingHandler::class)
            ->willReturn(new DoSomethingHandler());

        $registeredCommands = RegisteredCommands::fromArray(
            require_once __DIR__ . '/../Fixture/Command/commands.php'
        );

        $commandBus = new CommandBus(
            $registeredCommands,
            $handlerProvider
        );

        self::assertSame(
            'something id',
            $commandBus->handle($command)
        );
    }
}
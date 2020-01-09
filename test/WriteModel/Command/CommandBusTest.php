<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Command;

use Comquer\WriteModel\Command\CommandBus;
use Comquer\WriteModel\Command\CommandHandlerProvider;
use Comquer\Test\ComquerTest;
use Comquer\TestVendor\Football\GameId;
use Comquer\TestVendor\Football\StartGame\StartGame;
use Comquer\TestVendor\Football\StartGame\StartGameException;

class CommandBusTest extends ComquerTest
{
    /** @test */
    function handle_start_game_command()
    {
        $commandHandlerProvider = new CommandHandlerProvider(
            $this->buildCommandConfiguration(),
            $this->buildCommandHandlerContainer()
        );

        $commandBus = new CommandBus($commandHandlerProvider);

        $gameId = GameId::generate();
        $commandBus(new StartGame($gameId));

        $gameEvents = $this->eventStore->getByAggregateId($gameId);
        self::assertCount(1, $gameEvents);
    }

    /** @test */
    function handle_invalid_operation()
    {
        $commandHandlerProvider = new CommandHandlerProvider(
            $this->buildCommandConfiguration(),
            $this->buildCommandHandlerContainer()
        );

        $commandBus = new CommandBus($commandHandlerProvider);

        $gameId = GameId::generate();
        $commandBus(new StartGame($gameId));

        $exception = StartGameException::gameAlreadyStarted($gameId);

        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        $commandBus(new StartGame($gameId));
    }
}
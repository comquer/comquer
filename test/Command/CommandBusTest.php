<?php declare(strict_types=1);

namespace Comquer\Test\Command;

use Comquer\Command\CommandBus;
use Comquer\Command\CommandHandlerProvider;
use Comquer\Test\ComquerTest;
use Comquer\TestVendor\Football\GameId;
use Comquer\TestVendor\Football\StartGame\StartGame;

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
}
<?php declare(strict_types=1);

namespace Comquer\Test\Command;

use Comquer\Command\CommandBus;
use Comquer\Command\CommandHandlerProvider;
use Comquer\Command\Configuration\CommandConfiguration;
use Comquer\Command\Configuration\CommandConfigurationEntry;
use Comquer\Event\EventStore;
use Comquer\Test\ComquerTest;
use Comquer\TestVendor\Football\EndGame\EndGame;
use Comquer\TestVendor\Football\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\GameId;
use Comquer\TestVendor\Football\StartGame\StartGame;
use Comquer\TestVendor\Football\StartGame\StartGameHandler;

class CommandBusTest extends ComquerTest
{
    /** @test */
    function handle_start_game_command()
    {
        $commandConfiguration = new CommandConfiguration([
            new CommandConfigurationEntry(StartGame::class, StartGameHandler::class),
            new CommandConfigurationEntry(EndGame::class, EndGameHandler::class),
        ]);

        /** @var EventStore $eventStore */
        $eventStore = ($this->eventStoreBuilder)();

        $commandHandlerContainer = (new CommandHandlerContainerFactory())($eventStore);
        $commandHandlerProvider = new CommandHandlerProvider($commandConfiguration, $commandHandlerContainer);
        $commandBus = new CommandBus($commandHandlerProvider);

        $gameId = GameId::generate();
        $commandBus(new StartGame($gameId));

        $gameEvents = $eventStore->getByAggregateId($gameId);
        self::assertCount(1, $gameEvents);
    }
}
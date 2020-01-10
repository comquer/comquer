<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Command;

use Comquer\WriteModel\Command\CommandBus;
use Comquer\Test\ComquerTest;
use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGame;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGameException;
use Comquer\WriteModel\Event\EventStore;

class CommandBusTest extends ComquerTest
{
    /** @test */
    function handle_start_game_command()
    {
        $commandBus = $this->container->get(CommandBus::class);

        $gameId = GameId::generate();
        $commandBus(new StartGame($gameId));

        $eventStore = $this->container->get(EventStore::class);
        $gameEvents = $eventStore->getByAggregateId($gameId);

        self::assertCount(1, $gameEvents);
    }

    /** @test */
    function handle_invalid_operation()
    {
        $commandBus = $this->container->get(CommandBus::class);

        $gameId = GameId::generate();
        $commandBus(new StartGame($gameId));

        $exception = StartGameException::gameAlreadyStarted($gameId);

        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        $commandBus(new StartGame($gameId));
    }
}
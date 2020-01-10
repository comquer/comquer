<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel;

use Comquer\ReadModel\Http\Request;
use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGame;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGame;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGameHandler;
use Comquer\WriteModel\Command\Command;
use Comquer\WriteModel\Command\Configuration\CommandConfiguration;
use Comquer\WriteModel\Command\Configuration\CommandConfigurationEntry;
use Comquer\WriteModel\Http\Endpoint;
use Comquer\WriteModel\Http\EndpointCollection;
use Comquer\WriteModel\Http\RequestHydrator;
use DI\Container;

final class Bootstrap
{
    public function __invoke() : Container {
        $container = new Container();

        // Register WriteModel endpoints
        $container->set(EndpointCollection::class, new EndpointCollection([
            new Endpoint('start-game', new class implements RequestHydrator {
                public function __invoke(Request $request) : Command
                {
                    $gameId = new GameId($request->getParameterValue('gameId'));
                    return new StartGame($gameId);
                }
            }),

            new Endpoint('end-game', new class implements RequestHydrator {
                public function __invoke(Request $request) : Command
                {
                    $gameId = new GameId($request->getParameterValue('gameId'));
                    return new EndGame($gameId);
                }
            }),
        ]));

        // Register commands
        $container
            ->set(CommandConfiguration::class, new CommandConfiguration([
                new CommandConfigurationEntry(StartGame::class, StartGameHandler::class),
                new CommandConfigurationEntry(EndGame::class, EndGameHandler::class),
            ]));

        $container->set(\Comquer\WriteModel\Event\EventStore::class, new \Comquer\TestVendor\Event\Store\EventStore());
        $container->set(\Comquer\ReadModel\Event\EventStore::class, $container->get(\Comquer\WriteModel\Event\EventStore::class));

        return $container;
    }
}

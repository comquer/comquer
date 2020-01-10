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
                    return new StartGame(GameId::generate());
                }
            }),

            new Endpoint('end-game', new class implements RequestHydrator {
                public function __invoke(Request $request) : Command
                {
                    $gameId = new GameId($request->getParameter('gameId'));
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

        return $container;
    }
}

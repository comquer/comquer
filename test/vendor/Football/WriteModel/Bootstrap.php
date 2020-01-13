<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel;

use Comquer\Persistence\Database\DatabaseClient;
use Comquer\Persistence\Database\DatabaseClientFactory;
use Comquer\Persistence\Database\MongoDb\ClientFactory;
use Comquer\ReadModel\Event\Configuration\EventConfiguration;
use Comquer\ReadModel\Event\Configuration\EventConfigurationEntry;
use Comquer\ReadModel\Http\Request;
use Comquer\Reflection\ClassName\ClassName;
use Comquer\Reflection\ClassName\ClassNameCollection;
use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGame;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\WriteModel\EndGame\GameEnded;
use Comquer\TestVendor\Football\WriteModel\StartGame\GameStarted;
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
        $container->set(CommandConfiguration::class, new CommandConfiguration([
                new CommandConfigurationEntry(new ClassName(StartGame::class), new ClassName(StartGameHandler::class)),
                new CommandConfigurationEntry( new ClassName(EndGame::class), new ClassName( EndGameHandler::class)),
            ]));

        // Register events
        $container->set(EventConfiguration::class, new EventConfiguration([
            new EventConfigurationEntry(new ClassName(GameStarted::class), new ClassNameCollection()),
            new EventConfigurationEntry(new ClassName(GameEnded::class), new ClassNameCollection()),
        ]));

        $container->set(DatabaseClient::class, ClientFactory::create('localhost', 27017, 'football'));

        return $container;
    }
}

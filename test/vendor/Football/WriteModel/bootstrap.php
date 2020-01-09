<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel;

use Comquer\ReadModel\Http\Request;
use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\WriteModel\Application;
use Comquer\WriteModel\Command\Command;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGame;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGame;
use Comquer\WriteModel\Http\Endpoint;
use Comquer\WriteModel\Http\RequestHydrator;

function bootstrap() : Application {
    $application = new Application();

    $application->registerEndpoint(new Endpoint('start-game', new class implements RequestHydrator {
        public function __invoke(Request $request) : Command
        {
            return new StartGame(GameId::generate());
        }
    }));

    $application->registerEndpoint(new Endpoint('end-game', new class implements RequestHydrator {
        public function __invoke(Request $request) : Command
        {
            $gameId = new GameId($request->getParameter('gameId'));
            return new EndGame($gameId);
        }
    }));

    return $application;
}

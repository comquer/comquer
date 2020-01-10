<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\ReadModel;

use Comquer\WriteModel\Command\Command;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGame;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGame;

function bootstrapApplication() : Application {
    $application = new Application();

    $application->registerEndpoint(new Endpoint('start-game', new class implements RequestHydrator {
        public function __invoke(PostRequest $request) : Command
        {
            return new StartGame(GameId::generate());
        }
    }));

    $application->registerEndpoint(new Endpoint('end-game', new class implements RequestHydrator {
        public function __invoke(PostRequest $request) : Command
        {
            $gameId = new GameId($request->getParameter('gameId'));
            return new EndGame($gameId);
        }
    }));

    return $application;
}

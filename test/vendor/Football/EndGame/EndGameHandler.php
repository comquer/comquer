<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\EndGame;

use Comquer\TestVendor\Football\GameCommandHandler;
use Comquer\TestVendor\Football\GameId;

final class EndGameHandler extends GameCommandHandler
{
    public function __invoke(EndGame $command) : void
    {
        $this->gameMustBeOngoing($command->getGameId());

        ($this->eventDispatcher)(new GameEnded($command->getGameId()));
    }

    private function gameMustBeOngoing(GameId $gameId) : void
    {
        if ($this->gameRepository->isGameOngoing($gameId) === false) {
            throw EndGameException::gameNotOngoing($gameId);
        }
    }
}
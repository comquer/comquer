<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel\EndGame;

use Comquer\TestVendor\Football\WriteModel\GameCommandHandler;
use Comquer\TestVendor\Football\ReadModel\GameId;

final class EndGameHandler extends GameCommandHandler
{
    public function __invoke(\Comquer\WriteModel\Command\Command $command) : void
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
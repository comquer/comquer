<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\StartGame;

use Comquer\TestVendor\Football\GameCommandHandler;
use Comquer\TestVendor\Football\GameId;

final class StartGameHandler extends GameCommandHandler
{
    public function __invoke(StartGame $command) : void
    {
        $this->gameMustNotBeStarted($command->getGameId());

        ($this->eventDispatcher)(new GameStarted($command->getGameId()));
    }

    private function gameMustNotBeStarted(GameId $gameId) : void
    {
        if ($this->gameRepository->isGameStarted($gameId) === true) {
            throw StartGameException::gameAlreadyStarted($gameId);
        }
    }
}
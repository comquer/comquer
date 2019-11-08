<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\Event\EventStoreRepository;
use Comquer\TestVendor\Football\EndGame\GameEnded;
use Comquer\TestVendor\Football\StartGame\GameStarted;

final class GameRepository extends EventStoreRepository
{
    public function isGameStarted(GameId $gameId) : bool
    {
        $gameEvents = $this->eventStore->getByAggregateId($gameId);

        return $gameEvents->containsOfType(GameStarted::class) === true;
    }

    public function isGameOngoing(GameId $gameId) : bool
    {
        $gameEvents = $this->eventStore->getByAggregateId($gameId);

        $gameStarted = $gameEvents->containsOfType(GameStarted::class);
        $gameEnded = $gameEvents->containsOfType(GameEnded::class);

        return $gameStarted === true && $gameEnded === false;
    }
}
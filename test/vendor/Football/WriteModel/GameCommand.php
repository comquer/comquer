<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel;

use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\WriteModel\Command\Command;

abstract class GameCommand extends Command
{
    private GameId $gameId;

    public function __construct(GameId $gameId)
    {
        $this->gameId = $gameId;
    }

    public function getGameId() : GameId
    {
        return $this->gameId;
    }
}
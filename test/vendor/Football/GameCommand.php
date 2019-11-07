<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\Command\Command;

abstract class GameCommand extends Command
{
    private $gameId;

    public function __construct(GameId $gameId)
    {
        $this->gameId = $gameId;
    }

    public function getGameId() : GameId
    {
        return $this->gameId;
    }
}
<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel\StartGame;

use Comquer\TestVendor\Football\ReadModel\GameId;
use RuntimeException;

class StartGameException extends RuntimeException
{
    public static function gameAlreadyStarted(GameId $gameId) : self
    {
        return new self("Game `$gameId` is already started");
    }
}
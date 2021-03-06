<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel\EndGame;

use Comquer\TestVendor\Football\ReadModel\GameId;
use RuntimeException;

class EndGameException extends RuntimeException
{
    public static function gameNotOngoing(GameId $gameId) : self
    {
        return new self("Game `$gameId` is not ongoing");
    }
}
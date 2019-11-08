<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\EndGame;

use Comquer\TestVendor\Football\GameId;
use RuntimeException;

class EndGameException extends RuntimeException
{
    public static function gameIsNotOngoing(GameId $gameId) : self
    {
        return new self("Game `$gameId` is not ongoing");
    }
}
<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel\EndGame;

use Comquer\TestVendor\Football\ReadModel\GameEvent;

final class GameEnded extends GameEvent
{
    private const EVENT_NAME = 'game ended';

    public static function getEventName() : string
    {
        return self::EVENT_NAME;
    }
}
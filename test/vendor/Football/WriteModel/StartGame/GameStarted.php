<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel\StartGame;

use Comquer\TestVendor\Football\ReadModel\GameEvent;

final class GameStarted extends GameEvent
{
    private const EVENT_NAME = 'game started';

    public static function getEventName() : string
    {
        return self::EVENT_NAME;
    }
}
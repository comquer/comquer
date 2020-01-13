<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event\Configuration;

use RuntimeException;

class EventConfigurationException extends RuntimeException
{
    public static function eventNotFoundByName(string $eventName) : self
    {
        return new self("Event `$eventName` was not found");
    }
}
<?php declare(strict_types=1);

namespace Comquer\Event\Listener;

use RuntimeException;

class EventListenerConfigException extends RuntimeException
{
    public static function nameAndClassNameMismatch(string $listenerName, string $listenerClassName) : self
    {
        return new self("Provided listener name $listenerName and the one from $listenerClassName do not match");
    }

    public static function listenerNotFoundByName(string $listenerName) : self
    {
        return new self("Listener by name $listenerName is not in the config");
    }
}
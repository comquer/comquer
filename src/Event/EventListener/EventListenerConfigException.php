<?php declare(strict_types=1);

namespace Comquer\Event\EventListener;

use RuntimeException;

class EventListenerConfigException extends RuntimeException
{
    public static function nameAndClassNameMismatch(string $listenerName, string $listenerClassName)
    {
        return new self("Provided listener name $listenerName and the one from $listenerClassName do not match");
    }
}
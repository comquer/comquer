<?php declare(strict_types=1);

namespace Comquer\Event;

use RuntimeException;

final class EventCollectionException extends RuntimeException
{
    public static function eventOfTypeNotFound(string $type): self
    {
        return new self("Events of type `$type` was not found");
    }

    public static function empty() : self
    {
        return new self('Collection is empty');
    }
}
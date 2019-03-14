<?php declare(strict_types=1);

namespace Comquer\Event\Store;

use Comquer\Event\Event;

interface DeserializableEvent
{
    public static function deserialize(array $event): Event;
}

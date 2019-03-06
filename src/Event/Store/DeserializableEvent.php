<?php declare(strict_types=1);

namespace CQRS\Event\Store;

use CQRS\Event\Event;

interface DeserializableEvent
{
    public static function deserialize(array $event): Event;
}

<?php declare(strict_types=1);

namespace Comquer\Event\Store;

use Comquer\Event\Event;

interface EventStore
{
    public function registerEvent(Event $event): EventId;

    public function getById(EventId $eventId): Event;
}

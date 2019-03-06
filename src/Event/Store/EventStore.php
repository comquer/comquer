<?php declare(strict_types=1);

namespace CQRS\Event\Store;

use CQRS\Event\Event;

interface EventStore
{
    public function registerEvent(Event $event): EventStoreId;

    public function getById(EventStoreId $eventId): Event;
}

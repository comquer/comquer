<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event;

abstract class EventStoreRepository
{
    protected EventStore $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }
}
<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event;

abstract class EventStoreRepository
{
    protected \Comquer\WriteModel\Event\EventStore $eventStore;

    public function __construct(\Comquer\WriteModel\Event\EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }
}
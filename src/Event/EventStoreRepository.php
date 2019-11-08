<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Event\EventStore;

abstract class EventStoreRepository
{
    protected $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }
}
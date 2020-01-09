<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event;

use Comquer\ReadModel\Event\Event;
use Comquer\WriteModel\Event\EventStore;

class EventDispatcher implements \Comquer\WriteModel\Event\EventDispatcher
{
    private EventStore $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function __invoke(Event $event) : void
    {
        $this->eventStore->persist($event);
    }
}
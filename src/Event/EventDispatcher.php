<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Event\Queue\EventQueue;
use Comquer\Event\Store\EventStore;

class EventDispatcher
{
    /** @var EventStore */
    private $eventStore;

    /** @var EventQueue */
    private $eventQueue;

    public function __construct(EventStore $eventStore, EventQueue $eventQueue)
    {
        $this->eventStore = $eventStore;
        $this->eventQueue = $eventQueue;
    }

    public function dispatch(Event $event): void
    {
        $this->eventStore->registerEvent($event);
        $this->eventQueue->push($event->serialize());
    }
}
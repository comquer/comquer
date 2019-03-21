<?php declare(strict_types=1);

namespace Comquer\Event\Dispatcher;

use Comquer\Domain\Event;
use Comquer\Event\Queue\EventQueue;
use Comquer\Event\Store\EventStore;

class EventDispatcher implements \Comquer\Domain\EventDispatcher
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
        $eventId = $this->eventStore->registerEvent($event);
        $this->eventQueue->push($eventId);
    }
}
<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\Persistence\Queue\QueuePublisher;
use Comquer\ReadModel\Event\Event;

class EventDispatcher
{
    private EventStore $eventStore;

    private QueuePublisher $queuePublisher;

    public function __construct(EventStore $eventStore, QueuePublisher $queuePublisher)
    {
        $this->eventStore = $eventStore;
        $this->queuePublisher = $queuePublisher;
    }

    public function __invoke(Event $event) : void
    {
        $this->eventStore->persist($event);

        ($this->queuePublisher)('events', $event->serialize());
    }
}
<?php declare(strict_types=1);

namespace CQRS\Event\Queue;

use CQRS\BusException;
use CQRS\Event\Bus\EventBus;
use CQRS\Event\Store\EventStore;
use CQRS\Queue\Queue;
use CQRS\Queue\QueueConsumer;

class EventQueueConsumer implements QueueConsumer
{
    private $eventStore;

    private $eventBus;

    public function __construct(EventStore $eventStore, EventBus $eventBus)
    {
        $this->eventStore = $eventStore;
        $this->eventBus = $eventBus;
    }

    public function consume(Queue $queue): void
    {
        while ($queue->isEmpty() === false) {
            $event = $this->eventStore->getById($queue->pullNext());
            try {
                $this->eventBus->handle($event);
            } catch (BusException $exception) {
                // @todo Log failure
            }
        }
    }
}
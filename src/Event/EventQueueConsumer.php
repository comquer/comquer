<?php declare(strict_types=1);

namespace CommandQueryEvent\Event;

use CommandQueryEvent\Queue;
use CommandQueryEvent\QueueConsumer;

class EventQueueConsumer implements QueueConsumer
{
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function consumeQueue(Queue $queue)
    {
        while ($queue->isEmpty() === false) {
            $this->eventBus->handle(
                $queue->getNext()
            );
        }
    }
}
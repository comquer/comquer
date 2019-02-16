<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Queue;
use CQRS\QueueConsumer;

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
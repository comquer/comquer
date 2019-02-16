<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Queue\Queue;
use CQRS\Queue\QueueConsumer;

class EventQueueConsumer implements QueueConsumer
{
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function consume(Queue $queue)
    {
        while ($queue->isEmpty() === false) {
            $this->eventBus->handle(
                $queue->getNext()
            );
        }
    }
}
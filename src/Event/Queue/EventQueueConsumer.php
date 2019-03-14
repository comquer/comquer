<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

use Comquer\BusException;
use Comquer\Event\Bus\EventBus;
use Comquer\Event\Store\EventStore;
use Comquer\Queue\Queue;
use Comquer\Queue\QueueConsumer;

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
<?php declare(strict_types=1);

namespace Comquer\Queue;

use Comquer\BusException;
use Comquer\Event\Bus\EventBus;
use Comquer\Event\Store\EventStore;
use Comquer\Queue\QueueConsumer;

class EventQueueConsumer
{
    public function __construct()
    {
        $this->eventStore = $eventStore;
        $this->eventBus = $eventBus;
    }

    public function consume(EventListenerQueue $queue): void
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
<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\EventQueue;
use Comquer\Event\EventListener\EventListenerProvider;

class EventQueueConsumer
{
    /** @var EventListenerProvider */
    private $listenerProvider;

    public function __construct(EventListenerProvider $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
    }

    public function consume(EventQueue $eventQueue) : void
    {
        /** @var EventQueueItem $eventQueueItem */
        foreach ($eventQueue->pullNext() as $eventQueueItem) {
            /** @var EventListener $eventListener */
            $eventListener = $this->listenerProvider->getByName($eventQueueItem->getListenerName());
            $eventListener($eventQueueItem->getEvent());
        }
    }
}

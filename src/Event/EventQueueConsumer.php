<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegrationIntegrationIntegration\Event\EventQueue;
use Psr\Container\ContainerInterface;

class EventQueueConsumer
{
    /** @var ContainerInterface */
    private $listenerProvider;

    public function __construct(ContainerInterface $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
    }

    public function consume(EventQueue $eventQueue) : void
    {
        /** @var EventQueueItem $eventQueueItem */
        foreach ($eventQueue->pullNext() as $eventQueueItem) {
            $this->listenerProvider->get($eventQueueItem->getListenerName());
        }
    }
}

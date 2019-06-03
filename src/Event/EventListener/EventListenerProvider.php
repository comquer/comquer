<?php declare(strict_types=1);

namespace Comquer\Event\EventListener;

use Comquer\DomainIntegrationIntegrationIntegration\Event\EventQueue;
use Comquer\Event\EventQueueItem;
use Psr\Container\ContainerInterface;

class EventListenerProvider
{
    /** @var ContainerInterface */
    private $container;

    private $listenersConfig;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function consume(EventQueue $eventQueue) : void
    {
        /** @var EventQueueItem $eventQueueItem */
        foreach ($eventQueue->pullNext() as $eventQueueItem) {
            $this->container->get($eventQueueItem->getListenerName());
        }

    }
}

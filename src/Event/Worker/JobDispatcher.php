<?php declare(strict_types=1);

namespace Comquer\Event\Worker;

use Comquer\Event\Store\EventId;
use Comquer\Event\Store\EventStore;
use Comquer\Event\Subscription\EventSubscription;
use Psr\Container\ContainerInterface;

class JobDispatcher
{
    /** @var ContainerInterface */
    private $container;

    /** @var EventStore */
    private $eventStore;

    public function __construct(ContainerInterface $container, EventStore $eventStore)
    {
        $this->container = $container;
        $this->eventStore = $eventStore;
    }

    public function processSubscription(EventId $eventId, EventSubscription $subscription): void
    {
        $eventListener = $this->container->get($subscription->getListenerClassName());
        $event = $this->eventStore->getById($eventId);

        $eventListener->processEvent($event);
    }
}
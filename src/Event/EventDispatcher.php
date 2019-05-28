<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\Event;
use Comquer\DomainIntegration\Event\EventStore;
use Comquer\DomainIntegrationIntegrationIntegration\Event\EventQueue;

class EventDispatcher implements \Comquer\DomainIntegration\Event\EventDispatcher
{
    /** @var EventStore */
    private $eventStore;

    /** @var EventSubscriptionCollection */
    private $eventSubscriptionCollection;

    /** @var EventQueue */
    private $eventQueue;

    public function __construct(EventStore $eventStore, EventSubscriptionCollection $eventSubscriptionCollection, EventQueue $eventQueue)
    {
        $this->eventStore = $eventStore;
        $this->eventSubscriptionCollection = $eventSubscriptionCollection;
        $this->eventQueue = $eventQueue;
    }

    public function dispatch(Event $event) : void
    {
        $this->eventStore->persist($event);
        $subscriptions = $this->eventSubscriptionCollection->getForEvent($event);

        /** @var EventSubscription $subscription */
        foreach ($subscriptions as $subscription) {
            $this->eventQueue->push(new EventQueueItem($event, $subscription->getListenerName()));
        }
    }
}

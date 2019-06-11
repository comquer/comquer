<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\Event;
use Comquer\DomainIntegration\Event\EventQueueItemPublisher;
use Comquer\DomainIntegration\Event\EventStore;
use Comquer\Event\Queue\EventQueueItem;
use Comquer\Event\Subscription\EventSubscription;
use Comquer\Event\Subscription\EventSubscriptionProvider;

class EventDispatcher implements \Comquer\DomainIntegration\Event\EventDispatcher
{
    /** @var EventStore */
    private $eventStore;

    /** @var EventSubscriptionProvider */
    private $eventSubscriptionProvider;

    /** @var EventQueueItemPublisher */
    private $eventQueueItemPublisher;

    public function __construct(
        EventStore $eventStore,
        EventSubscriptionProvider $eventSubscriptionProvider,
        EventQueueItemPublisher $eventQueueItemPublisher
    ) {
        $this->eventStore = $eventStore;
        $this->eventSubscriptionProvider = $eventSubscriptionProvider;
        $this->eventQueueItemPublisher = $eventQueueItemPublisher;
    }

    public function dispatch(Event $event) : void
    {
        $this->eventStore->persist($event);
        $subscriptions = $this->eventSubscriptionProvider->getForEvent($event);

        /** @var EventSubscription $subscription */
        foreach ($subscriptions as $subscription) {
            $this->eventQueueItemPublisher->publish(new EventQueueItem($event, $subscription->getListenerName()));
        }
    }
}

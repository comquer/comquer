<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Event\Event;
use Comquer\Event\Queue\EventQueueItemPublisher;
use Comquer\Event\Store\EventStore;
use Comquer\Event\Queue\EventQueueItem;
use Comquer\Event\Subscription\EventNameSubscription;
use Comquer\Event\Subscription\EventSubscriptionProvider;

class EventDispatcher implements \Comquer\Event\EventDispatcher
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

        /** @var EventNameSubscription $subscription */
        foreach ($subscriptions as $subscription) {
            $this->eventQueueItemPublisher->publish(new EventQueueItem($event, $subscription->getListenerName()));
        }
    }
}

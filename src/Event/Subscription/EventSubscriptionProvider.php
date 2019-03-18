<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Event\Event;

class EventSubscriptionProvider
{
    /** @var EventSubscriptionCollection */
    private $eventSubscriptions;

    public function __construct(EventSubscriptionCollection $eventSubscriptions)
    {
        $this->eventSubscriptions = $eventSubscriptions;
    }

    public function getForEvent(Event $event): EventSubscriptionCollection
    {
        $eventSubscriptions = new EventSubscriptionCollection();

        /** @var EventSubscription $subscription */
        foreach ($this->eventSubscriptions as $subscription) {
            if ($subscription->getEventClassName() === get_class($event)) {
                $eventSubscriptions->add($subscription);
            }
        }

        return $eventSubscriptions;
    }
}
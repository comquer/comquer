<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Event\Event;

final class EventSubscriptionProvider
{
    /** @var EventSubscriptionCollection */
    private $subscriptionCollection;

    public function __construct(EventSubscriptionCollection $subscriptionCollection)
    {
        $this->subscriptionCollection = $subscriptionCollection;
    }

    public function getForEvent(Event $event) : EventSubscriptionCollection
    {
        /** @var EventSubscriptionCollection $filteredSubscriptions */
        $filteredSubscriptions = new $this->subscriptionCollection();

        /** @var Subscription $subscription */
        foreach ($this->subscriptionCollection as $subscription) {
            if ($subscription->isForEvent($event)) {
                $filteredSubscriptions->add($subscription);
            }
        }

        return $filteredSubscriptions;
    }
}
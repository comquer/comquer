<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Collection\Collection;
use Collection\Type;
use Collection\UniqueIndex;

class EventSubscriptionCollection extends Collection
{
    public function __construct(array $subscriptions = [])
    {
        parent::__construct(
            $subscriptions,
            Type::object(EventSubscription::class),
            new UniqueIndex(function (EventSubscription $subscription) {
                return $subscription->getEventClassName() . $subscription->getListenerClassName();
            })
        );
    }
}
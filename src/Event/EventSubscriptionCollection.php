<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

class EventSubscriptionCollection extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(EventSubscription::class),
            new UniqueIndex(function (EventSubscription $subscription) {
                return "{$subscription->getEventName()}{$subscription->getListenerName()}";
            })
        );
    }
}
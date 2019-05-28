<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\DomainIntegration\Event\Event;

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

    public function getForEvent(Event $event) : self
    {
        $filtered = new self();

        /** @var EventSubscription $subscription */
        foreach ($this as $subscription) {
            if ($subscription->getEventName() === $event::getName()) {
                $filtered->add($subscription);
            }
        }

        return $filtered;
    }
}
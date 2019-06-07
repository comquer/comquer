<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\DomainIntegration\Event\Event;

class EventSubscriptionProvider extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(Subscription::class),
            new UniqueIndex(function (Subscription $subscription) {
                return (string) $subscription;
            })
        );
    }

    public static function fromArrayConfig(array $subscriptions) : self
    {
        $collection = new self();
        $collection = self::parseEventNamesConfig($subscriptions, $collection);
        $collection = self::parseAggregateTypesConfig($subscriptions, $collection);

        return $collection;
    }

    private static function parseEventNamesConfig(array $subscriptions, self $collection) : self
    {
        if (
            isset($subscriptions['eventNames']) === false
            || is_array($subscriptions['eventNames'] === false)
        ) {
            return $collection;
        }

        foreach ($subscriptions['eventNames'] as $eventName => $listeners) {
            foreach ($listeners as $listenerName) {
                $collection->add(new EventSubscription($eventName, $listenerName));
            }
        }

        return $collection;
    }

    private static function parseAggregateTypesConfig(array $subscriptions, self $collection) : self
    {
        if (
            isset($subscriptions['aggregateTypes']) === false
            || is_array($subscriptions['aggregateTypes'] === false)
        ) {
            return $collection;
        }

        foreach ($subscriptions['aggregateTypes'] as $aggregateType => $listeners) {
            foreach ($listeners as $listenerName) {
                $collection->add(new AggregateEventsSubscription(new AggregateType($aggregateType), $listenerName));
            }
        }

        return $collection;
    }

    public function getForEvent(Event $event) : self
    {
        $filtered = new self();

        foreach ($this as $subscription) {
            switch (get_class($subscription)) {
                case EventSubscription::class:
                    /** @var EventSubscription $subscription */
                    if ($subscription->getEventName() === $event::getName()) {
                        $filtered->add($subscription);
                    }
                    break;
                case AggregateEventsSubscription::class:
                    /** @var AggregateEventsSubscription $subscription*/
                    if ((string) $subscription->getAggregateType() === (string) $event->getAggregateType()) {
                        $filtered->add($subscription);
                    }
                    break;
                default:
                    throw EventSubscriptionProviderException::unexpectedSubscriptionImplementation(get_class($subscription));
            }
        }

        return $filtered;
    }
}
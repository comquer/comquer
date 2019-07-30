<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Event\AggregateType;

class EventSubscriptionCollection extends Collection
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

    public static function fromConfig(array $subscriptions) : self
    {
        self::validateConfigStructure($subscriptions);
        $collection = new self();

        foreach (EventSubscriptionType::list() as $subscriptionType) {
            $collection->addMany(
                self::parseConfigForSubscriptionType($subscriptions[$subscriptionType], $subscriptionType)
            );
        }

        return $collection;
    }

    private static function validateConfigStructure(array $subscriptions) : void
    {
        foreach (EventSubscriptionType::list() as $subscriptionType) {
            if (isset($subscriptions[$subscriptionType]) === false) {
                throw EventSubscriptionException::missingKeyFromArrayConfig($subscriptionType);
            }

            if (is_array($subscriptions[$subscriptionType]) === false) {
                throw EventSubscriptionException::invalidValueUnderKey($subscriptionType);
            }
        }
    }

    private static function parseConfigForSubscriptionType(array $subscriptions, string $subscriptionType) : self
    {
        $eventSubscriptionCollection = new self();

        foreach ($subscriptions as $key => $listeners) {
            switch ($subscriptionType) {
                case EventSubscriptionType::EVENT_NAMES:
                    $eventSubscriptionCollection->addMany(
                        self::parseEventNameSubscriptions($key, $listeners)
                    );
                    break;
                case EventSubscriptionType::AGGREGATE_TYPES:
                    $eventSubscriptionCollection->addMany(
                        self::parseAggregateTypeSubscriptions($key, $listeners)
                    );
                    break;
                default:
                    throw EventSubscriptionException::unexpectedSubscriptionType($subscriptionType);
            }
        }

        return $eventSubscriptionCollection;
    }

    private static function parseEventNameSubscriptions(string $eventName, array $listeners) : EventSubscriptionCollection
    {
        $eventSubscriptionCollection = new self();

        foreach ($listeners as $listenerName) {
            $eventSubscriptionCollection->add(
                new EventNameSubscription($eventName, $listenerName)
            );
        }

        return $eventSubscriptionCollection;
    }

    private static function parseAggregateTypeSubscriptions(string $aggregateType, array $listeners) : EventSubscriptionCollection
    {
        $eventSubscriptionCollection = new self();

        foreach ($listeners as $listenerName) {
            $eventSubscriptionCollection->add(
                new AggregateTypeSubscription(new AggregateType($aggregateType), $listenerName)
            );
        }

        return $eventSubscriptionCollection;
    }
}
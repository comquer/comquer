<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\DomainIntegration\Event\Event;
use Comquer\Event\AggregateType;
use Comquer\Event\Subscription\EventSubscriptionArrayConfigKeyName as ConfigKey;

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

    public static function fromConfig(array $subscriptions) : self
    {
        $collection = new self();
        self::validateConfigStructure($subscriptions);
        $collection = self::parseEventNamesConfig($subscriptions, $collection);
        $collection = self::parseAggregateTypesConfig($subscriptions, $collection);

        return $collection;
    }

    public function getForEvent(Event $event) : self
    {
        $filteredSubscriptions = new self();

        foreach ($this as $subscription) {
            switch (get_class($subscription)) {
                case EventSubscription::class:
                    /** @var EventSubscription $subscription */
                    if ($subscription->getEventName() === $event::getName()) {
                        $filteredSubscriptions->add($subscription);
                    }
                    break;
                case AggregateEventsSubscription::class:
                    /** @var AggregateEventsSubscription $subscription*/
                    if ((string) $subscription->getAggregateType() === (string) $event->getAggregateType()) {
                        $filteredSubscriptions->add($subscription);
                    }
                    break;
                default:
                    throw EventSubscriptionProviderException::unexpectedSubscriptionImplementation(get_class($subscription));
            }
        }

        return $filteredSubscriptions;
    }

    private static function parseConfig(array $subscriptions, self $collection) : self
    {
        foreach (ConfigKey::list() as $subscriptionType) {
            self::parseConfigType( )
        }

        foreach ($subscriptions[(string) ConfigKey::EVENT_NAMES()] as $eventName => $listeners) {
            foreach ($listeners as $listenerName) {
                $collection->add(new EventSubscription($eventName, $listenerName));
            }
        }

        foreach ($subscriptions[(string) ConfigKey::AGGREGATE_TYPES()] as $aggregateType => $listeners) {
            foreach ($listeners as $listenerName) {
                $collection->add(new AggregateEventsSubscription(new AggregateType($aggregateType), $listenerName));
            }
        }

        return $collection;


    }

    private static function parseAggregateTypesConfig(array $subscriptions, self $collection) : self
    {
    }

    private static function validateConfigStructure(array $subscriptions) : void
    {
        if (isset($subscriptions[(string) ConfigKey::EVENT_NAMES()]) === false) {
            throw EventSubscriptionProviderException::missingEventNamesKeyFromArrayConfig();
        }

        if (is_array($subscriptions[(string) ConfigKey::EVENT_NAMES()]) === false) {
            throw EventSubscriptionProviderException::invalidValueOfEventNames();
        }

        if (isset($subscriptions[(string) ConfigKey::AGGREGATE_TYPES()]) === false) {
            throw EventSubscriptionProviderException::missingAggregateTypesKeyFromArrayConfig();
        }

        if (is_array($subscriptions[(string) ConfigKey::AGGREGATE_TYPES()]) === false) {
            throw EventSubscriptionProviderException::invalidValueOfAggregateTypes();
        }
    }
}
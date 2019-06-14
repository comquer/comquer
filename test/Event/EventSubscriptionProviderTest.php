<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\Subscription\AggregateEventsSubscription;
use Comquer\Event\AggregateType;
use Comquer\Event\Subscription\EventSubscription;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use Comquer\Event\Subscription\EventSubscriptionProviderException;
use ComquerTest\Fixture\Event\CustomerBilled;
use ComquerTest\Fixture\Event\NotifyAdminAboutUserCreation;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use ComquerTest\Fixture\Event\UpdateUserProjection;
use ComquerTest\Fixture\Event\UserCreated;
use PHPUnit\Framework\TestCase;
use Comquer\Event\Subscription\EventSubscriptionArrayConfigKeyName as ConfigKey;

class EventSubscriptionProviderTest extends TestCase
{
    static function getArrayConfig() : array
    {
        return [
            (string) ConfigKey::EVENT_NAMES() => [
                UserCreated::getName() => [
                    NotifyAdminAboutUserCreation::getName(),
                    UpdateUserProjection::getName(),
                ],
            ],
            (string) ConfigKey::AGGREGATE_TYPES() => [
                (string) new AggregateType('shopping list') => [
                    UpdateShoppingListProjection::getName(),
                ],
                (string) new AggregateType('user') => [
                    UpdateShoppingListProjection::getName(),
                ]
            ],
        ];
   }

    /** @test */
    function create_from_array_config()
    {
        $subscriptions = EventSubscriptionProvider::fromArrayConfig(self::getArrayConfig());
        self::assertCount(4, $subscriptions);
    }

    /** @test */
    function get_for_event()
    {
        $subscriptions = EventSubscriptionProvider::fromArrayConfig(self::getArrayConfig())->getForEvent(new UserCreated());

        self::assertCount(3, $subscriptions);

        foreach ($subscriptions as $subscription) {
            if ($subscription instanceof EventSubscription) {
                /** @var EventSubscription $subscription */
                self::assertSame(UserCreated::getName(), $subscription->getEventName());
            }

            if ($subscription instanceof AggregateEventsSubscription) {
                /** @var AggregateEventsSubscription $subscription */
                self::assertEquals(new AggregateType('user'), $subscription->getAggregateType());
            }

            $subscription->getListenerName();
        }
    }

    /** @test */
    function get_for_event_if_none_registered()
    {
        $subscriptions = EventSubscriptionProvider::fromArrayConfig(self::getArrayConfig())->getForEvent(new CustomerBilled());

        self::assertTrue($subscriptions->isEmpty());
    }

    /** @test */
    function throw_exception_if_eventNames_key_is_missing_from_array_config()
    {
        $exception = EventSubscriptionProviderException::missingEventNamesKeyFromArrayConfig();
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionProvider::fromArrayConfig([
            // missing event names
            (string) ConfigKey::AGGREGATE_TYPES() => [],
        ]);
    }

    /** @test */
    function throw_exception_if_aggregateTypes_key_is_missing_from_array_config()
    {
        $exception = EventSubscriptionProviderException::missingAggregateTypesKeyFromArrayConfig();
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionProvider::fromArrayConfig([
            (string) ConfigKey::EVENT_NAMES() => [],
            // missing aggregate types
        ]);
    }

    /** @test */
    function throw_exception_if_eventNames_value_is_not_an_array()
    {
        $exception = EventSubscriptionProviderException::invalidValueOfEventNames();
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionProvider::fromArrayConfig([
            (string) ConfigKey::EVENT_NAMES() => 'not an array',
            (string) ConfigKey::AGGREGATE_TYPES() => [],
        ]);
    }

    /** @test */
    function throw_exception_if_aggregateTypes_value_is_not_an_array()
    {
        $exception = EventSubscriptionProviderException::invalidValueOfAggregateTypes();
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionProvider::fromArrayConfig([
            (string) ConfigKey::EVENT_NAMES() => [],
            (string) ConfigKey::AGGREGATE_TYPES() => 'not a string',
        ]);
    }
}
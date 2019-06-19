<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\Subscription\AggregateTypeSubscription;
use Comquer\Event\AggregateType;
use Comquer\Event\Subscription\EventNameSubscription;
use Comquer\Event\Subscription\EventSubscriptionCollection;
use Comquer\Event\Subscription\EventSubscriptionException;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use Comquer\Event\Subscription\EventSubscriptionType;
use ComquerTest\Fixture\Event\NotifyAdminAboutUserCreation;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use ComquerTest\Fixture\Event\UpdateUserProjection;
use ComquerTest\Fixture\Event\UserCreated;
use PHPUnit\Framework\TestCase;

class EventSubscriptionProviderTest extends TestCase
{
    static function getConfig() : array
    {
        return [
            EventSubscriptionType::EVENT_NAMES => [
                UserCreated::getName() => [
                    NotifyAdminAboutUserCreation::getName(),
                    UpdateUserProjection::getName(),
                ],
            ],
            EventSubscriptionType::AGGREGATE_TYPES => [
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
        $subscriptions = EventSubscriptionCollection::fromConfig(self::getConfig());
        self::assertCount(4, $subscriptions);
    }

    /** @test */
    function get_for_event()
    {
        $subscriptionProvider = new EventSubscriptionProvider(
            EventSubscriptionCollection::fromConfig(self::getConfig())
        );

        $userCreatedSubscriptions = $subscriptionProvider->getForEvent(new UserCreated());

        self::assertCount(3, $userCreatedSubscriptions);

        foreach ($userCreatedSubscriptions as $subscription) {
            if ($subscription instanceof EventNameSubscription) {
                /** @var EventNameSubscription $subscription */
                self::assertSame(UserCreated::getName(), $subscription->getEventName());
            }

            if ($subscription instanceof AggregateTypeSubscription) {
                /** @var AggregateTypeSubscription $subscription */
                self::assertEquals(new AggregateType('user'), $subscription->getAggregateType());
            }

            $subscription->getListenerName();
        }
    }

    /** @test */
    function throws_exception_if_event_names_key_is_missing_from_array_config()
    {
        $exception = EventSubscriptionException::missingKeyFromArrayConfig(EventSubscriptionType::EVENT_NAMES);
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionCollection::fromConfig([
//            EventSubscriptionType::EVENT_NAMES => [],
            EventSubscriptionType::AGGREGATE_TYPES => [],
        ]);
    }

    /** @test */
    function exception_if_aggregate_types_key_is_missing_from_array_config()
    {
        $exception = EventSubscriptionException::missingKeyFromArrayConfig(EventSubscriptionType::AGGREGATE_TYPES);
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionCollection::fromConfig([
            EventSubscriptionType::EVENT_NAMES => [],
//            EventSubscriptionType::AGGREGATE_TYPES => [],
        ]);
    }

    /** @test */
    function exception_if_event_names_value_is_not_an_array()
    {
        $exception = EventSubscriptionException::invalidValueUnderKey(EventSubscriptionType::EVENT_NAMES);
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionCollection::fromConfig([
            EventSubscriptionType::EVENT_NAMES => 'not an array',
            EventSubscriptionType::AGGREGATE_TYPES => [],
        ]);
    }

    /** @test */
    function exception_if_aggregate_types_value_is_not_an_array()
    {
        $exception = EventSubscriptionException::invalidValueUnderKey(EventSubscriptionType::AGGREGATE_TYPES);
        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        EventSubscriptionCollection::fromConfig([
            EventSubscriptionType::EVENT_NAMES => [],
            EventSubscriptionType::AGGREGATE_TYPES => 'not an array',
        ]);
    }
}
<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\Subscription\AggregateEventsSubscription;
use Comquer\Event\AggregateType;
use Comquer\Event\Subscription\EventSubscription;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use ComquerTest\Fixture\Event\CustomerBilled;
use ComquerTest\Fixture\Event\NotifyAdminAboutUserCreation;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use ComquerTest\Fixture\Event\UpdateUserProjection;
use ComquerTest\Fixture\Event\UserCreated;
use PHPUnit\Framework\TestCase;

class EventSubscriptionProviderTest extends TestCase
{
    static function getArrayConfig() : array
    {
        return [
            'eventNames' => [
                UserCreated::getName() => [
                    NotifyAdminAboutUserCreation::getName(),
                    UpdateUserProjection::getName(),
                ],
            ],
            'aggregateTypes' => [
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
}
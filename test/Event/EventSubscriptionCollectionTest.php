<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\EventSubscription;
use Comquer\Event\EventSubscriptionCollection;
use ComquerTest\Fixture\Event\CustomerBilled;
use ComquerTest\Fixture\Event\ItemAdded;
use ComquerTest\Fixture\Event\NotifyAdminAboutUserCreation;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use ComquerTest\Fixture\Event\UpdateUserProjection;
use ComquerTest\Fixture\Event\UserCreated;
use PHPUnit\Framework\TestCase;

class EventSubscriptionCollectionTest extends TestCase
{
    static function getArrayConfig() : array
    {
        return [
            UserCreated::getName() => [
                NotifyAdminAboutUserCreation::getName(),
                UpdateUserProjection::getName(),
            ],
            ItemAdded::getName() => [
                UpdateShoppingListProjection::getName(),
            ],
        ];
   }

    /** @test */
    function create_from_array_config()
    {
        $subscriptions = EventSubscriptionCollection::fromArrayConfig(self::getArrayConfig());
        self::assertCount(3, $subscriptions);
    }

    /** @test */
    function get_for_event()
    {
        $subscriptions = EventSubscriptionCollection::fromArrayConfig(self::getArrayConfig())->getForEvent(new UserCreated());

        self::assertCount(2, $subscriptions);

        /** @var EventSubscription $subscription */
        foreach ($subscriptions as $subscription) {
            self::assertSame(UserCreated::getName(), $subscription->getEventName());
            $subscription->getListenerName();
        }
    }

    /** @test */
    function get_for_event_if_none_registered()
    {
        $subscriptions = EventSubscriptionCollection::fromArrayConfig(self::getArrayConfig())->getForEvent(new CustomerBilled());

        self::assertTrue($subscriptions->isEmpty());
    }
}
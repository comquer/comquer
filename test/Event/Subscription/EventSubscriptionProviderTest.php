<?php declare(strict_types=1);

namespace ComquerTest\Event\Subscription;

use Comquer\Event\Subscription\EventSubscription;
use Comquer\Event\Subscription\EventSubscriptionCollection;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use ComquerTest\Event\Fixture\Events\CatDied;
use ComquerTest\Event\Fixture\Events\CatEvent;
use ComquerTest\Event\Fixture\Events\DogDied;
use ComquerTest\Event\Fixture\Events\PetEvent;
use ComquerTest\Event\Fixture\Listeners\CatDiedListener;
use ComquerTest\Event\Fixture\Listeners\CatEventListener;
use ComquerTest\Event\Fixture\Listeners\DogDiedListener;
use ComquerTest\Event\Fixture\Listeners\PetEventListener;
use PHPUnit\Framework\TestCase;

class EventSubscriptionProviderTest extends TestCase
{
    /** @test */
    function get_subscriptions()
    {
        $subscriptionProvider = new EventSubscriptionProvider(new EventSubscriptionCollection([
            EventSubscription::fromNamespaces(PetEvent::class, PetEventListener::class),
            EventSubscription::fromNamespaces(CatEvent::class, CatEventListener::class),
            EventSubscription::fromNamespaces(CatDied::class, CatDiedListener::class),
            EventSubscription::fromNamespaces(DogDied::class, DogDiedListener::class),
        ]));

        $catSubscriptions = $subscriptionProvider->getForEvent(new CatDied('Tigger'));

        self::assertCount(3, $catSubscriptions);
    }
}
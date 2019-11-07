<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\Queue\EventQueueItemPublisher;
use Comquer\Event\Store\EventStore;
use Comquer\Event\EventDispatcher;
use Comquer\Event\Queue\EventQueueItem;
use Comquer\Event\Subscription\EventNameSubscription;
use Comquer\Event\Subscription\EventSubscriptionCollection;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use ComquerTest\Fixture\Event\ItemAdded;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    /** @test */
    function instantiate_event_dispatcher()
    {
        $dispatcher = new EventDispatcher(
            $this->createMock(EventStore::class),
            new EventSubscriptionProvider(new EventSubscriptionCollection()),
            $this->createMock(EventQueueItemPublisher::class)
        );

        self::assertInstanceOf(
            \Comquer\Event\EventDispatcher::class,
            $dispatcher
        );
    }

    /** @test */
    function dispatch_event()
    {
        $event = new ItemAdded();

        $eventStore = $this->createMock(EventStore::class);
        $eventStore->method('persist')->with($event);

        $subscriptionProvider = new EventSubscriptionProvider(new EventSubscriptionCollection([
            new EventNameSubscription($event::getName(), UpdateShoppingListProjection::getName())
        ]));

        $eventQueueItem = new EventQueueItem($event, UpdateShoppingListProjection::getName());

        $eventQueue = $this->createMock(EventQueueItemPublisher::class);
        $eventQueue->method('publish')->with($eventQueueItem);

        $eventDispatcher = new EventDispatcher($eventStore, $subscriptionProvider, $eventQueue);

        self::assertNull(
            $eventDispatcher->dispatch($event)
        );
    }
}
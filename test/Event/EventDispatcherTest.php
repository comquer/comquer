<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\DomainIntegration\Event\Queue\EventQueueItemPublisher;
use Comquer\DomainIntegration\Event\Store\EventStore;
use Comquer\Event\EventDispatcher;
use Comquer\Event\Queue\EventQueueItem;
use Comquer\Event\Subscription\EventSubscription;
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
            new EventSubscriptionProvider(),
            $this->createMock(EventQueueItemPublisher::class)
        );

        self::assertInstanceOf(
            \Comquer\DomainIntegration\Event\EventDispatcher::class,
            $dispatcher
        );
    }

    /** @test */
    function dispatch_event()
    {
        $event = new ItemAdded();

        $eventStore = $this->createMock(EventStore::class);
        $eventStore->method('persist')->with($event);

        $subscriptionProvider = new EventSubscriptionProvider([
            new EventSubscription($event::getName(), UpdateShoppingListProjection::getName())
        ]);

        $eventQueueItem = new EventQueueItem($event, UpdateShoppingListProjection::getName());

        $eventQueue = $this->createMock(EventQueueItemPublisher::class);
        $eventQueue->method('publish')->with($eventQueueItem);

        $eventDispatcher = new EventDispatcher($eventStore, $subscriptionProvider, $eventQueue);

        self::assertNull(
            $eventDispatcher->dispatch($event)
        );
    }
}
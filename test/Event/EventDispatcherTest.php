<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\DomainIntegration\Event\EventDispatcher;
use Comquer\DomainIntegration\Event\EventQueue;
use Comquer\DomainIntegration\Event\EventStore;
use Comquer\Event\EventQueueItem;
use Comquer\Event\EventSubscription;
use Comquer\Event\EventSubscriptionCollection;
use ComquerTest\Fixture\Event\ItemAdded;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    /** @test */
    function instantiate_event_dispatcher()
    {
        self::assertInstanceOf(
            EventDispatcher::class,
            new \Comquer\Event\EventDispatcher(
                $this->createMock(EventStore::class),
                new EventSubscriptionCollection(),
                $this->createMock(EventQueue::class)

            )
        );
    }

    /** @test */
    function dispatch_event()
    {
        $event = new ItemAdded();

        $eventStore = $this->createMock(EventStore::class);
        $eventStore->method('persist')->with($event);

        $eventSubscriptionCollection = new EventSubscriptionCollection([
            new EventSubscription($event::getName(), UpdateShoppingListProjection::getName())
        ]);

        $eventQueueItem = new EventQueueItem($event, UpdateShoppingListProjection::getName());

        $eventQueue = $this->createMock(EventQueue::class);
        $eventQueue->method('push')->with($eventQueueItem);

        $eventDispatcher = new \Comquer\Event\EventDispatcher($eventStore, $eventSubscriptionCollection, $eventQueue);

        self::assertNull(
            $eventDispatcher->dispatch($event)
        );
    }
}
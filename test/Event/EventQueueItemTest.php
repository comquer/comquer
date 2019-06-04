<?php declare(strict_types=1);

namespace ComquerTest\Event;

use Comquer\Event\EventQueueItem;
use ComquerTest\Fixture\Event\ItemAdded;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use PHPUnit\Framework\TestCase;

class EventQueueItemTest extends TestCase
{
    /** @test */
    function getters()
    {
        $event = new ItemAdded();
        $eventQueueItem = new EventQueueItem($event, UpdateShoppingListProjection::getName());

        self::assertSame($event, $eventQueueItem->getEvent());
        self::assertSame(UpdateShoppingListProjection::getName(), $eventQueueItem->getListenerName());
    }
}
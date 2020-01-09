<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event\Store;

use Comquer\ReadModel\Event\AggregateId;
use Comquer\ReadModel\Event\AggregateType;
use Comquer\ReadModel\Event\Event;
use Comquer\ReadModel\Event\EventCollection;

final class EventStore implements \Comquer\WriteModel\Event\EventStore
{
    private EventCollection $eventCollection;

    public function __construct(EventCollection $eventCollection = null)
    {
        $this->eventCollection = $eventCollection ?: new EventCollection();
    }

    public function getByQuery(array $query) : EventCollection
    {
        $queriedEvents = new EventCollection();

        /** @var Event $event */
        foreach ($this->eventCollection as $event) {
            if (array_intersect($query, $event->serialize()) == $query) {
                $queriedEvents->add($event);
            }
        }

        return $queriedEvents;
    }

    public function getByAggregateId(AggregateId $aggregateId) : EventCollection
    {
        return $this->getByQuery([
            'aggregateId' => (string) $aggregateId,
        ]);
    }

    public function getByAggregateType(AggregateType $aggregateType) : EventCollection
    {
        return $this->getByQuery([
            'aggregateType' => (string) $aggregateType,
        ]);
    }

    public function persist(Event $event) : void
    {
        $this->eventCollection->add($event);
    }
}
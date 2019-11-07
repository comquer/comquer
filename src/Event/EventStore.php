<?php declare(strict_types=1);

namespace Comquer\Event;

interface EventStore
{
    public function persist(Event $event) : void;

    public function getByQuery(array $query) : EventCollection;

    public function getByAggregateId(AggregateId $aggregateId) : Event;

    public function getByAggregateType(AggregateType $aggregateType) : EventCollection;
}
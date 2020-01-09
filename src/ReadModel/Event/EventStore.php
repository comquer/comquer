<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event;

interface EventStore
{
    public function getByQuery(array $query) : EventCollection;

    public function getByAggregateId(AggregateId $aggregateId) : EventCollection;

    public function getByAggregateType(AggregateType $aggregateType) : EventCollection;
}
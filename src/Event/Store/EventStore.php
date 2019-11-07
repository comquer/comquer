<?php declare(strict_types=1);

namespace Comquer\Event\Store;

use Comquer\Event\AggregateId;
use Comquer\Event\AggregateType;
use Comquer\Event\Event;
use Comquer\Event\EventCollection;

interface EventStore
{
    public function persist(Event $event) : void;

    public function getByQuery(array $query) : EventCollection;

    public function getByAggregateId(AggregateId $aggregateId) : Event;

    public function getByAggregateType(AggregateType $aggregateType) : EventCollection;
}
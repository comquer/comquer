<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event;

use Comquer\ReadModel\Serialization\Deserializable;
use Comquer\ReadModel\Serialization\Serializable;
use DateTimeImmutable;

abstract class Event implements Serializable, Deserializable
{
    private AggregateId $aggregateId;

    private AggregateType $aggregateType;

    private DateTimeImmutable $occurredOn;

    public function __construct(AggregateId $aggregateId, AggregateType $aggregateType, DateTimeImmutable $occurredOn)
    {
        $this->aggregateId = $aggregateId;
        $this->aggregateType = $aggregateType;
        $this->occurredOn = $occurredOn;
    }

    abstract public static function getEventName() : string;

    public function getAggregateId() : AggregateId
    {
        return $this->aggregateId;
    }

    public function getAggregateType() : AggregateType
    {
        return $this->aggregateType;
    }

    public function getOccurredOn() : DateTimeImmutable
    {
        return $this->occurredOn;
    }
}